@extends('layouts.app')

@section('title', 'Chat with ' . $other->name)

@section('content')
<div class="page narrow">

    <div class="chat-wrapper">

        <div class="chat-header">
            <a href="{{ route('dashboard') }}" class="chat-back">← Back</a>
            <div class="chat-user-info">
                <div class="chat-avatar">{{ strtoupper(substr($other->name, 0, 1)) }}</div>
                <div class="profile-hover-wrap">
                    <strong>{{ $other->name }}</strong>
                    <small>{{ ucfirst($other->role) }} · Matched ✓</small>

                    <div class="profile-hover-card">
                        <div class="hover-card-top">
                            <div class="hover-avatar">{{ strtoupper(substr($other->name, 0, 1)) }}</div>
                            <div>
                                <strong>{{ $other->name }}</strong>
                                <small>{{ ucfirst($other->role) }}</small>
                            </div>
                        </div>
                        @if ($other->profile)
                            @if ($other->profile->headline)
                                <p class="hover-headline">{{ $other->profile->headline }}</p>
                            @endif
                            <dl class="hover-details">
                                @if ($other->profile->department)
                                    <div><dt>Department</dt><dd>{{ $other->profile->department }}</dd></div>
                                @endif
                                @if ($other->profile->level)
                                    <div><dt>Level</dt><dd>{{ $other->profile->level }}</dd></div>
                                @endif
                            </dl>
                            @if ($other->profile->interests->count())
                                <div class="hover-interests">
                                    @foreach ($other->profile->interests as $interest)
                                        <span>{{ $interest->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if ($other->profile->bio)
                                <p class="hover-bio">{{ Str::limit($other->profile->bio, 100) }}</p>
                            @endif
                        @endif
                    </div>
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

<style>
.chat-wrapper {
    background: #fff;
    border: 1px solid #d7dee8;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(23,33,43,.10);
    display: flex;
    flex-direction: column;
    height: calc(100vh - 140px);
    min-height: 500px;
}

.chat-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px 24px;
    border-bottom: 1px solid #d7dee8;
    background: #fff;
}

.chat-back {
    color: #1457d9;
    font-weight: 700;
    font-size: .9rem;
    white-space: nowrap;
}

.chat-back:hover { opacity: .7; }

.chat-user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.chat-avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #e84a5f;
    color: #fff;
    display: grid;
    place-items: center;
    font-weight: 900;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.chat-user-info > div > strong {
    display: block;
    font-size: 1rem;
}

.chat-user-info > div > small {
    color: #237a57;
    font-size: .78rem;
    font-weight: 600;
}

.chat-window {
    flex: 1;
    overflow-y: auto;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f7f9fc;
}

.chat-empty {
    margin: auto;
    text-align: center;
    color: #667085;
}

.chat-empty-icon {
    font-size: 3rem;
    margin-bottom: 10px;
}

.chat-empty p { font-weight: 700; margin: 0; }
.chat-empty small { font-size: .85rem; }

.bubble-row { display: flex; align-items: flex-end; }
.bubble-row.mine  { justify-content: flex-end; }
.bubble-row.theirs { justify-content: flex-start; }

.bubble {
    max-width: 68%;
    padding: 10px 16px;
    border-radius: 20px;
    line-height: 1.5;
    word-break: break-word;
}

.bubble-row.mine .bubble {
    background: #1457d9;
    color: #fff;
    border-bottom-right-radius: 5px;
}

.bubble-row.theirs .bubble {
    background: #fff;
    color: #17212b;
    border-bottom-left-radius: 5px;
    border: 1px solid #d7dee8;
    box-shadow: 0 2px 8px rgba(23,33,43,.06);
}

.bubble-text { display: block; }

.bubble time {
    display: block;
    font-size: .68rem;
    opacity: .6;
    margin-top: 4px;
    text-align: right;
}

.bubble-row.theirs .bubble time { text-align: left; }

.chat-form {
    padding: 16px 20px;
    border-top: 1px solid #d7dee8;
    background: #fff;
}

.chat-input-row {
    display: flex;
    gap: 10px;
    align-items: center;
}

.chat-input-row input {
    flex: 1;
    border-radius: 999px;
    padding: 12px 20px;
    border: 1px solid #d7dee8;
    background: #f7f9fc;
    font-size: .95rem;
    transition: border-color .18s, box-shadow .18s;
}

.chat-input-row input:focus {
    outline: none;
    border-color: #1457d9;
    box-shadow: 0 0 0 3px rgba(20,87,217,.1);
    background: #fff;
}

.chat-send-btn {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #1457d9;
    color: #fff;
    border: 0;
    border-radius: 999px;
    padding: 12px 22px;
    font-weight: 700;
    cursor: pointer;
    font-size: .9rem;
    transition: background .18s, transform .18s;
}

.chat-send-btn:hover {
    background: #0d43b0;
    transform: translateY(-1px);
}

/* Hover profile card */
.profile-hover-wrap {
    position: relative;
    cursor: default;
}

.profile-hover-wrap > strong {
    display: inline-block;
    border-bottom: 1px dashed #b8c7dc;
    cursor: pointer;
    font-size: 1rem;
}

.profile-hover-card {
    display: none;
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    width: 260px;
    background: #fff;
    border: 1px solid #d7dee8;
    border-radius: 16px;
    padding: 16px;
    box-shadow: 0 20px 50px rgba(23,33,43,.18);
    z-index: 999;
}

.profile-hover-wrap > strong:hover ~ .profile-hover-card,
.profile-hover-card:hover {
    display: block;
}

.hover-card-top {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.hover-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e84a5f;
    color: #fff;
    display: grid;
    place-items: center;
    font-weight: 900;
    flex-shrink: 0;
}

.hover-card-top strong {
    display: block;
    font-size: .95rem;
    border: none !important;
    padding: 0 !important;
    cursor: default;
}

.hover-card-top small {
    color: #667085;
    font-size: .75rem;
}

.hover-headline {
    font-weight: 700;
    color: #1457d9;
    margin: 0 0 8px;
    font-size: .85rem;
}

.hover-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px;
    margin: 0 0 8px;
}

.hover-details div {
    background: #f7f9fc;
    border: 1px solid #d7dee8;
    border-radius: 8px;
    padding: 6px 8px;
}

.hover-details dt {
    font-size: .68rem;
    color: #667085;
}

.hover-details dd {
    margin: 2px 0 0;
    font-size: .8rem;
    font-weight: 800;
}

.hover-interests {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 8px;
}

.hover-interests span {
    background: #eef4ff;
    color: #1457d9;
    border-radius: 999px;
    padding: 3px 9px;
    font-size: .72rem;
    font-weight: 700;
}

.hover-bio {
    color: #667085;
    font-size: .8rem;
    line-height: 1.5;
    margin: 0;
    border-top: 1px solid #d7dee8;
    padding-top: 8px;
}
</style>

@endsection