<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Connection $connection)
    {
        $user = auth()->user();

        // Only allow matched users to view the chat
        abort_unless(
            $connection->status === 'matched' &&
            ($connection->sender_id === $user->id || $connection->receiver_id === $user->id),
            403
        );

        $messages = $connection->messages()->with('sender')->orderBy('created_at')->get();
        $other    = $connection->sender_id === $user->id
                        ? $connection->receiver
                        : $connection->sender;

        return view('messages.show', compact('connection', 'messages', 'other'));
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