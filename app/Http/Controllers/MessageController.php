<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $messages = Message::with(['connection.sender', 'connection.receiver', 'sender'])
            ->when($search, fn ($query) => $query->where('body', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('messages.index', compact('messages', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create', [
            'message' => new Message(),
            'connections' => Connection::with(['sender', 'receiver'])->orderByDesc('created_at')->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create($this->validatedData($request));

        return redirect()->route('messages.show', $message)->with('success', 'Message sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $message->load(['connection.sender', 'connection.receiver', 'sender']);

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        return view('messages.edit', [
            'message' => $message,
            'connections' => Connection::with(['sender', 'receiver'])->orderByDesc('created_at')->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $message->update($this->validatedData($request));

        return redirect()->route('messages.show', $message)->with('success', 'Message updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'connection_id' => ['required', 'exists:connections,id'],
            'sender_id' => ['required', 'exists:users,id'],
            'body' => ['required', 'string', 'min:2', 'max:1000'],
            'read_at' => ['nullable', 'date'],
        ]);
    }
}
