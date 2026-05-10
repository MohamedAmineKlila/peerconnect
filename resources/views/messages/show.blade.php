@extends('layouts.app')

@section('title', 'Chat with ' . $other->name)

@section('content')
<div class="chat-page">

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

        @php
            $youAreSender = $connection->sender_id === auth()->id();
            $youAccepted = $currentUserAccepted ?? false;
            $otherAccepted = $otherUserAccepted ?? false;
            $bothAccepted = $youAccepted && $otherAccepted;
        @endphp

        <div class="chat-layout">
            <div class="chat-main">

                @if($meeting)
                    <div class="meeting-summary" aria-label="Scheduled meeting summary">
                        <strong>Scheduled meeting</strong>
                        <div class="meeting-detail">
                            <span>When</span>
                            <span>{{ $meeting->scheduled_at ? $meeting->scheduled_at->format('F j, Y \a\t H:i') : 'To be set' }}</span>
                        </div>
                        <div class="meeting-detail">
                            <span>Duration</span>
                            <span>{{ $meeting->duration_hours ? $meeting->duration_hours . ' hours' : 'Not specified' }}</span>
                        </div>
                        <div class="meeting-detail">
                            <span>Subject</span>
                            <span>{{ $meeting->subject ?? 'Not specified' }}</span>
                        </div>
                        <div class="meeting-detail">
                            <span>Mode</span>
                            <span>{{ $meeting->online ? 'Online' : 'In person' }}</span>
                        </div>
                        <div class="meeting-detail">
                            <span>Where</span>
                            <span>{{ $meeting->location ?? 'Not specified yet' }}</span>
                        </div>
                        <div class="meeting-detail">
                            <span>Agenda</span>
                            <span>{{ $meeting->agenda ?? 'Not defined yet' }}</span>
                        </div>
                    </div>
                @endif

                <div class="chat-window" id="chat-window">
                    @forelse ($messages as $message)
                        <div class="bubble-row {{ $message->sender_id === auth()->id() ? 'mine' : 'theirs' }}">
                            <div class="bubble">
                                <span class="bubble-text">{{ $message->body }}</span>
                                <time>{{ $message->created_at->format('H:i') }}</time>
                            </div>
                        </div>
                    @empty
                        <div class="chat-empty" aria-live="polite">
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

            <aside class="meeting-panel" aria-label="Meeting status and actions">
                <div class="meeting-status-card">
                    <strong>Meeting status</strong>
                    <p>{{ $meeting ? 'Confirmed for your session.' : 'Waiting for both people to accept.' }}</p>
                    <ul>
                        <li>Your acceptance: <strong>{{ $youAccepted ? 'Yes' : 'No' }}</strong></li>
                        <li>Other acceptance: <strong>{{ $otherAccepted ? 'Yes' : 'No' }}</strong></li>
                    </ul>
                </div>

                <div class="meeting-actions">
                    <form method="POST" action="{{ route('meeting.accept', $connection) }}">
                        @csrf
                        <button type="submit" class="meeting-action-btn" {{ $youAccepted || $meeting ? 'disabled' : '' }}>
                            {{ $meeting ? 'Meeting Confirmed' : ($youAccepted ? 'Accepted' : 'Accept Meeting') }}
                        </button>
                    </form>

                    @if($meeting)
                        <div class="meeting-card">
                            <h3>Meeting details</h3>
                            <div class="meeting-detail-row">
                                <span>When</span>
                                <span>{{ $meeting->scheduled_at ? $meeting->scheduled_at->format('F j, Y \a\t H:i') : 'Not scheduled yet' }}</span>
                            </div>
                            <div class="meeting-detail-row">
                                <span>Where</span>
                                <span>{{ $meeting->location ?? 'Not specified' }}</span>
                            </div>
                            <div class="meeting-detail-row">
                                <span>Agenda</span>
                                <span>{{ $meeting->agenda ?? 'No agenda yet' }}</span>
                            </div>
                        </div>
                    @elseif($bothAccepted)
                        <form method="POST" action="{{ route('meeting.schedule', $connection) }}" class="meeting-schedule-form">
                            @csrf
                            <div class="form-row">
                                <label>Date & Time</label>
                                <input type="datetime-local" name="scheduled_at" required />
                            </div>
                            <div class="form-row">
                                <label>Duration (hours)</label>
                                <input type="number" min="1" max="24" name="duration_hours" placeholder="e.g. 2" />
                            </div>
                            <div class="form-row">
                                <label>Subject</label>
                                <input type="text" name="subject" placeholder="e.g. Math tutoring" />
                            </div>
                            <div class="form-row">
                                <label>Online?</label>
                                <select name="online">
                                    <option value="1">Online</option>
                                    <option value="0">In person</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label>Location</label>
                                <input type="text" name="location" placeholder="Zoom/Google Meet/Room" />
                            </div>
                            <div class="form-row">
                                <label>Agenda</label>
                                <input type="text" name="agenda" placeholder="What are you discussing?" />
                            </div>
                            <button type="submit" class="meeting-action-btn">Confirm meeting details</button>
                        </form>
                    @else
                        <div class="meeting-card">
                            <p>Both users must accept the meeting before scheduling can begin.</p>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</div><!-- /.chat-page -->

<script>
    const win = document.getElementById('chat-window');
    if (win) win.scrollTop = win.scrollHeight;
</script>

<style>
.chat-page {
    width: min(100%, 1400px);
    max-width: 1400px;
    margin: 0 auto;
    padding: 16px 20px;
}

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
    width: 100%;
    gap: 0;
}

.chat-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px 24px;
    border-bottom: 1px solid #d7dee8;
    background: #fff;
    flex-shrink: 0;
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

/* ── Two-column layout ───────────────────────────────────────── */
.chat-layout {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(320px, 0.95fr);
    gap: 20px;
    align-items: stretch;
    flex: 1;
    min-height: 0;
    padding: 18px 20px;
    overflow: hidden;
}

/* ── Left column: conversation area ─────────────────────────── */
.chat-main {
    display: flex;
    flex-direction: column;
    min-width: 0;
    min-height: 0;
    height: 100%;
    flex: 1;
    gap: 0;
}

.chat-window {
    flex: 1;
    min-height: 0;
    overflow-y: auto;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f7f9fc;
    border-radius: 14px;
}

.chat-empty {
    margin: 0;
    padding: 40px 0;
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
    padding: 14px 18px;
    border-top: 1px solid #d7dee8;
    background: #fff;
    flex-shrink: 0;
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

/* ── Right column: meeting panel (independent scroll) ────────── */
.meeting-panel {
    display: flex;
    flex-direction: column;
    gap: 18px;
    height: 100%;
    overflow-y: auto;
    padding-right: 6px;
}

.meeting-panel::-webkit-scrollbar { width: 8px; }
.meeting-panel::-webkit-scrollbar-thumb {
    background: rgba(20,87,217,.25);
    border-radius: 999px;
}
.meeting-panel::-webkit-scrollbar-track {
    background: transparent;
}

.meeting-status-card,
.meeting-card {
    background: #fff;
    border: 1px solid #d7dee8;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 10px 30px rgba(23,33,43,.06);
}

.meeting-status-card strong,
.meeting-card h3 {
    display: block;
    margin-bottom: 10px;
    font-size: 1rem;
}

.meeting-status-card ul {
    list-style: none;
    padding: 0;
    margin: 12px 0 0;
    display: grid;
    gap: 8px;
}

.meeting-status-card li {
    font-size: .95rem;
    color: #39404a;
}

.meeting-actions {
    display: grid;
    gap: 14px;
}

.meeting-action-btn {
    width: 100%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    border: 0;
    border-radius: 14px;
    padding: 14px 16px;
    font-weight: 700;
    background: #1457d9;
    color: #fff;
    cursor: pointer;
    transition: background .18s ease, transform .18s ease;
}

.meeting-action-btn:disabled {
    opacity: .55;
    cursor: not-allowed;
}

.meeting-action-btn:hover:not(:disabled) {
    background: #0d43b0;
    transform: translateY(-1px);
}

/* Panel detail rows (right side) */
.meeting-detail-row {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 12px;
    align-items: center;
    margin-top: 10px;
}

.meeting-detail-row span:first-child {
    opacity: .7;
    font-weight: 700;
}

.meeting-schedule-form {
    display: grid;
    gap: 12px;
}

.meeting-schedule-form .form-row {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.meeting-schedule-form label {
    font-weight: 700;
    font-size: .92rem;
}

.meeting-schedule-form input,
.meeting-schedule-form select {
    width: 100%;
    border: 1px solid #d7dee8;
    border-radius: 12px;
    padding: 12px 14px;
    font-size: .95rem;
    background: #fff;
}

/* ── Compact horizontal meeting summary bar (top of chat) ────── */
.meeting-summary {
    flex-shrink: 0;
    background: #fff;
    border: 1px solid #d7dee8;
    border-radius: 12px;
    padding: 9px 14px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 4px 0;
    margin-bottom: 10px;
}

.meeting-summary strong {
    display: inline;
    font-size: .82rem;
    font-weight: 800;
    color: #17212b;
    white-space: nowrap;
    padding-right: 12px;
    margin-right: 4px;
    border-right: 1.5px solid #d7dee8;
    line-height: 1.8;
}

.meeting-summary .meeting-detail {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 0 10px;
    border-right: 1px solid #e8edf3;
    line-height: 1.8;
}

.meeting-summary .meeting-detail:last-child {
    border-right: none;
}

.meeting-summary .meeting-detail span:first-child {
    opacity: .6;
    font-weight: 700;
    font-size: .75rem;
    white-space: nowrap;
}

.meeting-summary .meeting-detail span:last-child {
    font-size: .78rem;
    color: #344054;
    white-space: nowrap;
    font-weight: 500;
}

/* ── Misc ────────────────────────────────────────────────────── */
.chat-notice {
    padding: 12px 16px;
    border-radius: 16px;
    background: #e7f7ee;
    color: #1f6a3b;
    border: 1px solid #c4e7d0;
    margin-bottom: 12px;
    font-weight: 700;
}

/* ── Hover profile card ──────────────────────────────────────── */
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

@media (max-width: 1120px) {
    .chat-layout {
        grid-template-columns: 1fr;
    }
}
</style>

@endsection
