@extends('layouts.app')

@section('title', 'Chat with ' . $other->name)

@section('content')
<div class="page narrow">

    <div class="chat-wrapper">

        <div class="chat-header">
            <a href="{{ route('dashboard') }}" class="chat-back">← Back</a>
            <div class="chat-user-info">
                <div class="chat-avatar">{{ strtoupper(substr($other->name, 0, 1)) }}</div>
                <div>
                    <strong>{{ $other->name }}</strong>
                    <small>{{ ucfirst($other->role) }} · Matched ✓</small>
                </div>
            </div>
        </div>

        <div class="chat-window" id="chat-window">
            @forelse ($messages as $message)
                <div class="bubble-row {{ $message->sender_id === auth()->id() ? 'mine' : 'theirs' }}">
                    <div class="bubble">
                        <span class="bubble-text">{{ $message->body }}</span>
                        <time>{{ $message->created_at->format('H:i') }}</time>
                    </div>
                </div>
            @empty
                <div class="chat-empty">
                    <div class="chat-empty-icon">💬</div>
                    <p>No messages yet.</p>
                    <small>Say hello to {{ $other->name }}!</small>
                </div>
            @endforelse
        </div>

        <form method="POST" action="{{ route('chat.store', $connection) }}" class="chat-form">
            @csrf
            @error('body')
                <p class="field-error">{{ $message }}</p>
            @enderror
            <div class="chat-input-row">
                <input
                    type="text"
                    name="body"
                    placeholder="Type a message..."
                    autocomplete="off"
                    required
                    class="{{ $errors->has('body') ? 'is-invalid' : '' }}"
                >
                <button type="submit" class="chat-send-btn">
                    <span>Send</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </div>
        </form>

    </div>

</div>

<script>
    const win = document.getElementById('chat-window');
    if (win) win.scrollTop = win.scrollHeight;
</script>
@endsection