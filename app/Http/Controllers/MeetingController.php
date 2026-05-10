<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Meeting;
use App\Models\MeetingAccept;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function accept(Connection $connection)
    {
        $user = auth()->user();

        abort_unless(
            $connection->status === 'matched' &&
            in_array($user->id, [$connection->sender_id, $connection->receiver_id], true),
            403
        );

        MeetingAccept::updateOrCreate(
            ['connection_id' => $connection->id, 'user_id' => $user->id],
            ['accepted' => true, 'accepted_at' => now()]
        );

        $other = $connection->sender_id === $user->id ? $connection->receiver : $connection->sender;
        session()->put('meeting_memory', [
            'connection_id' => $connection->id,
            'accepted' => true,
            'other_name' => $other->name,
            'note' => 'Both users need to accept before scheduling.',
        ]);

        return redirect()->route('chat.show', $connection)
            ->with('success', 'Meeting accepted. Once both users accept, schedule the session.');
    }

    public function schedule(Request $request, Connection $connection)
    {
        $user = auth()->user();

        abort_unless(
            $connection->status === 'matched' &&
            in_array($user->id, [$connection->sender_id, $connection->receiver_id], true),
            403
        );

        $accepts = MeetingAccept::where('connection_id', $connection->id)
            ->get()
            ->keyBy('user_id');

        abort_unless(
            ($accepts->get($connection->sender_id)?->accepted ?? false) &&
            ($accepts->get($connection->receiver_id)?->accepted ?? false),
            403
        );

        $data = $request->validate([
            'scheduled_at' => 'required|date',
            'duration_hours' => 'nullable|integer|min:1|max:24',
            'subject' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'online' => 'nullable|boolean',
            'agenda' => 'nullable|string|max:1000',
        ]);

        $data['online'] = $request->boolean('online');

        $meeting = Meeting::updateOrCreate(
            ['connection_id' => $connection->id],
            $data
        );

        session()->put('meeting_memory', [
            'connection_id' => $connection->id,
            'scheduled_at' => $meeting->scheduled_at?->format('F j, Y \a\t H:i'),
            'duration_hours' => $meeting->duration_hours,
            'subject' => $meeting->subject,
            'location' => $meeting->location,
            'online' => $meeting->online ? 'online' : 'in person',
            'agenda' => $meeting->agenda,
        ]);

        return redirect()->route('chat.show', $connection)
            ->with('success', 'Meeting scheduled. The agenda and schedule are now visible in chat.');
    }
}
