@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <section class="match-shell">
        <div class="match-topbar">
            <div>
                <p class="eyebrow">{{ ucfirst($user->role) }} mode</p>
                <h1>Discover {{ ucfirst($targetRole) }}s</h1>
                <p>
                    @if ($user->role === 'student')
                        Swipe through teachers and mentors who can help your academic projects.
                    @else
                        Swipe through students who are looking for academic guidance.
                    @endif
                </p>
            </div>
            @if ($ownProfile)
                <x-button :href="route('profiles.show', $ownProfile)" variant="secondary">My Profile</x-button>
            @else
                <x-button :href="route('profiles.create')">Complete Profile</x-button>
            @endif
        </div>

        <div class="user-stats">
            <article>
                <strong>{{ $remainingCount }}</strong>
                <span>Profiles left</span>
            </article>
            <article>
                <strong>{{ $incomingLikes->count() }}</strong>
                <span>New likes</span>
            </article>
            <article>
                <strong>{{ $matches->count() }}</strong>
                <span>Matches</span>
            </article>
            <article>
                <strong>{{ $likesSentCount }}</strong>
                <span>Likes sent</span>
            </article>
        </div>

        @unless ($ownProfile)
            <section class="onboarding-panel">
                <div>
                    <p class="eyebrow">First step</p>
                    <h2>Complete your profile to start matching</h2>
                    <p>Your profile is what other students and teachers see in the swipe deck. Add a headline, department, level, interests, and a short bio before you start swiping.</p>
                </div>
                <x-button :href="route('profiles.create')">Complete Profile</x-button>
            </section>
        @endunless

        <div class="tinder-layout">
            <div class="swipe-stage">
                @if (! $ownProfile)
                    <article class="empty-deck">
                        <h2>Your deck is locked</h2>
                        <p>Complete your profile first so other people know who they are matching with.</p>
                        <x-button :href="route('profiles.create')">Complete Profile</x-button>
                    </article>
                @elseif ($currentProfile)
                    <article class="swipe-card" data-swipe-card>
                        <div class="swipe-photo">
                            @if ($currentProfile->avatar_path)
                                <img src="{{ asset('storage/' . $currentProfile->avatar_path) }}" alt="{{ $currentProfile->user->name }}">
                            @else
                                <span>{{ strtoupper(substr($currentProfile->user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="swipe-content">
                            <p class="eyebrow">{{ ucfirst($currentProfile->user->role) }} - {{ $currentProfile->department }}</p>
                            <h2>{{ $currentProfile->user->name }}</h2>
                            <strong>{{ $currentProfile->headline }}</strong>
                            <p>{{ $currentProfile->bio }}</p>
                            <dl class="inline-details">
                                <div>
                                    <dt>Department</dt>
                                    <dd>{{ $currentProfile->department }}</dd>
                                </div>
                                <div>
                                    <dt>Level</dt>
                                    <dd>{{ $currentProfile->level ?? 'Not specified' }}</dd>
                                </div>
                                @if ($currentProfile->user->role === 'teacher')
                                    <div>
                                        <dt>Mentoring</dt>
                                        <dd>{{ $currentProfile->available_for_mentoring ? 'Available' : 'Not available' }}</dd>
                                    </div>
                                @endif
                            </dl>
                            <div class="tags">
                                @foreach ($currentProfile->interests as $interest)
                                    <span>{{ $interest->name }}</span>
                                @endforeach
                            </div>
                            <p class="match-hint">
                                @if ($user->role === 'student')
                                    Like this teacher if their expertise fits your project.
                                @else
                                    Like this student if you can guide their project.
                                @endif
                            </p>
                        </div>
                    </article>

                    <div class="swipe-actions">
                        <form method="POST" action="{{ route('dashboard.react', $currentProfile) }}" data-swipe-form="pass">
                            @csrf
                            <input type="hidden" name="status" value="passed">
                            <button class="swipe-btn pass" type="submit" aria-label="Pass">X</button>
                        </form>

                        <form method="POST" action="{{ route('dashboard.react', $currentProfile) }}" data-swipe-form="like">
                            @csrf
                            <input type="hidden" name="status" value="liked">
                            <button class="swipe-btn like" type="submit" aria-label="Like">♥</button>
                        </form>
                    </div>

                    <p class="deck-count">{{ $remainingCount }} profile{{ $remainingCount === 1 ? '' : 's' }} left in your deck.</p>
                @else
                    <article class="empty-deck">
                        <h2>No more profiles for now</h2>
                        <p>You reacted to everyone available. New {{ $targetRole }} profiles will appear here when more people join PeerConnect.</p>
                        <x-button :href="route('profiles.index')">Browse Profiles</x-button>
                    </article>
                @endif
            </div>

            <aside class="match-sidebar">
                <section class="activity-panel" id="likes">
                    <div class="sidebar-title">
                        <h2>People Who Liked Me</h2>
                        @if ($incomingLikes->count())
                            <span>{{ $incomingLikes->count() }}</span>
                        @endif
                    </div>
                    <div class="incoming-list">
                        @forelse ($incomingLikes as $like)
                            @php($profile = $like->sender->profile)
                            <article>
                                <div class="mini-person">
                                    <span>{{ strtoupper(substr($like->sender->name, 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $like->sender->name }}</strong>
                                        <small>{{ $profile?->department ?? ucfirst($like->sender->role) }}</small>
                                    </div>
                                </div>
                                <p>{{ $like->note ?? ($profile?->headline ?? 'Wants to connect with you.') }}</p>
                                @if ($profile)
                                    <form method="POST" action="{{ route('dashboard.react', $profile) }}" class="incoming-actions">
                                        @csrf
                                        <input type="hidden" name="status" value="liked">
                                        <button class="mini-action like-back" type="submit">Like Back</button>
                                    </form>
                                    <form method="POST" action="{{ route('dashboard.react', $profile) }}" class="incoming-actions">
                                        @csrf
                                        <input type="hidden" name="status" value="passed">
                                        <button class="mini-action pass-back" type="submit">Pass</button>
                                    </form>
                                @endif
                            </article>
                        @empty
                            <p>No new likes yet. Keep swiping and check back here.</p>
                        @endforelse
                    </div>
                </section>

                <section class="activity-panel" id="matches">
                    <h2>Matches</h2>
                    <div class="mini-match-list">
                        @forelse ($matches as $match)
                            @php($other = $match->sender_id === $user->id ? $match->receiver : $match->sender)
                            <div class="match-row">
                                <a href="{{ route('connections.show', $match) }}" class="match-info">
                                    <span>{{ strtoupper(substr($other->name, 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $other->name }}</strong>
                                        <small>{{ $match->matched_at?->format('Y-m-d') ?? 'Matched' }}</small>
                                    </div>
                                </a>
                                <a href="{{ route('chat.show', $match) }}" class="chat-pill">💬 Message</a>
                            </div>
                        @empty
                            <p>No matches yet. Press like on profiles you want to connect with.</p>
                        @endforelse
                    </div>
                </section>

                <section class="activity-panel">
                    <h2>Preview</h2>
                    <div class="preview-stack">
                        @foreach ($previewProfiles as $profile)
                            <a href="{{ route('profiles.show', $profile) }}">
                                <strong>{{ $profile->user->name }}</strong>
                                <small>{{ $profile->department }}</small>
                            </a>
                        @endforeach
                        @if ($previewProfiles->isEmpty())
                            <p>More {{ $targetRole }} profiles will appear here as people join.</p>
                        @endif
                    </div>
                </section>
            </aside>
        </div>
    </section>
@endsection