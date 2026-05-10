<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Meeting;
use App\Models\MeetingAccept;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Connection $connection)
    {
        $user = auth()->user();

        abort_unless(
            $connection->status === 'matched' &&
            ($connection->sender_id === $user->id || $connection->receiver_id === $user->id),
            403
        );

        $messages = $connection->messages()->with('sender')->orderBy('created_at')->get();
        $other    = $connection->sender_id === $user->id
                        ? $connection->receiver->load('profile.interests')
                        : $connection->sender->load('profile.interests');

        $accepts = \App\Models\MeetingAccept::where('connection_id', $connection->id)
            ->get()
            ->keyBy('user_id');

        $meeting = \App\Models\Meeting::where('connection_id', $connection->id)->first();

        $senderAccepted = (bool) optional($accepts->get($connection->sender_id))->accepted;
        $receiverAccepted = (bool) optional($accepts->get($connection->receiver_id))->accepted;

        $currentUserAccepted = $connection->sender_id === $user->id
            ? $senderAccepted
            : $receiverAccepted;

        $otherUserAccepted = $connection->sender_id === $user->id
            ? $receiverAccepted
            : $senderAccepted;

        return view('messages.show', compact(
            'connection',
            'messages',
            'other',
            'senderAccepted',
            'receiverAccepted',
            'currentUserAccepted',
            'otherUserAccepted',
            'meeting'
        ));
    }

    public function store(Request $request, Connection $connection)
    {
        $user = auth()->user();

        abort_unless(
            $connection->status === 'matched' &&
            ($connection->sender_id === $user->id || $connection->receiver_id === $user->id),
            403
        );

        $request->validate(['body' => 'required|string|max:1000']);

        Message::create([
            'connection_id' => $connection->id,
            'sender_id'     => $user->id,
            'body'          => $request->body,
        ]);

        return back();
    }
}
