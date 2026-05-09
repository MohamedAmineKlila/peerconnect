@extends('layouts.app')

@section('title', 'Chat with ' . $other->name)

@section('content')
<div class="page narrow">

    <div class="chat-header">
        <a href="{{ route('dashboard') }}" class="chat-back">← Back</a>
        <div class="mini-person">
            <span>{{ strtoupper(substr($other->name, 0, 1)) }}</span>
            <div>
                <strong>{{ $other->name }}</strong>
                <small>{{ ucfirst($other->role) }}</small>
            </div>
        </div>
    </div>

    <div class="chat-window" id="chat-window">
        @forelse ($messages as $message)
            <div class="bubble-row {{ $message->sender_id === auth()->id() ? 'mine' : 'theirs' }}">
                <div class="bubble">
                    {{ $message->body }}
                    <time>{{ $message->created_at->format('H:i') }}</time>
                </div>
            </div>
        @empty
            <p class="chat-empty">No messages yet. Say hello! 👋</p>
        @endforelse
    </div>

    <form method="POST" action="{{ route('chat.store', $connection) }}" class="chat-form">
        @csrf
        <input
            type="text"
            name="body"
            placeholder="Type a message..."
            autocomplete="off"
            required
            class="{{ $errors->has('body') ? 'is-invalid' : '' }}"
        >
        <button type="submit" class="btn btn-primary">Send</button>
    </form>

</div>

<script>
    // Auto-scroll to bottom of chat
    const win = document.getElementById('chat-window');
    if (win) win.scrollTop = win.scrollHeight;
</script>
@endsection