@extends('layouts.app')

@section('title', 'PeerConnect — Academic Matching Platform')

@section('content')

<div class="home-wrap">

{{-- ── HERO ── --}}
<section class="pc-hero">
    <div class="pc-hero-left">
        <div class="pc-eyebrow">Academic Matching Platform</div>
        <h1 class="pc-hero-title">
            Connect Students<br>with <span class="grad">the Right Teachers</span>
        </h1>
        <p class="pc-hero-sub">
            PeerConnect uses a Tinder-style swipe experience to match students and teachers around shared academic interests. Like, match, and start meaningful conversations.
        </p>
        <div class="pc-cta-row">
            @auth
                <a href="{{ route('dashboard') }}" class="pc-btn-primary">Go to Dashboard →</a>
                <a href="{{ route('profiles.index') }}" class="pc-btn-secondary">Browse Profiles</a>
            @else
                <a href="{{ route('register') }}" class="pc-btn-primary">Get Started Free →</a>
                <a href="{{ route('login') }}" class="pc-btn-secondary">Sign In</a>
            @endauth
        </div>
        <div class="pc-trust">
            <div class="pc-trust-item">Free to use</div>
            <div class="pc-trust-item">Academic profiles only</div>
            <div class="pc-trust-item">Private messaging</div>
        </div>
    </div>

    <div class="pc-hero-right">
        <div class="pc-float-badge pc-badge-match">It's a Match!</div>
        <div class="pc-float-badge pc-badge-chat">New message</div>
        <div class="pc-card-stack">
            <div class="pc-card pc-card-back-2"></div>
            <div class="pc-card pc-card-back-1"></div>
            <div class="pc-card pc-card-front">
                <div class="pc-card-photo">Y</div>
                <div class="pc-card-body">
                    <p class="pc-card-role">Teacher · Computer Science</p>
                    <h3 class="pc-card-name">Youssef Ben Ali</h3>
                    <p class="pc-card-headline">Laravel & AI specialist — 5 years of teaching experience at ESPRIT</p>
                    <div class="pc-card-tags">
                        <span>Laravel</span>
                        <span>Machine Learning</span>
                        <span>Data Analysis</span>
                    </div>
                </div>
                <div class="pc-card-btns">
                    <button class="pc-swipe-btn pc-pass">✕</button>
                    <div class="pc-match-pill">💚It's a Match!</div>
                    <button class="pc-swipe-btn pc-like">♥</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── DIVIDER ── --}}
<div class="pc-divider">
    <div class="pc-divider-line"></div>
    <div class="pc-divider-text">How it works</div>
    <div class="pc-divider-line"></div>
</div>

{{-- ── STEPS ── --}}
<section class="pc-steps-wrap pc-reveal">
    <div class="pc-steps-title">
        <h2>Three steps to your perfect match</h2>
    </div>
    <div class="pc-steps">
        <div class="pc-step">
            <div class="pc-step-num pc-step-num-1">👤</div>
            <h3>Build Your Profile</h3>
            <p>Register as a student or teacher. Add your department, level, bio, interests, and a profile photo.</p>
        </div>
        <div class="pc-step-arrow">→</div>
        <div class="pc-step">
            <div class="pc-step-num pc-step-num-2">👆</div>
            <h3>Swipe & Discover</h3>
            <p>Browse one profile at a time filtered by academic role. Like the ones that fit your goals — pass the rest.</p>
        </div>
        <div class="pc-step-arrow">→</div>
        <div class="pc-step">
            <div class="pc-step-num pc-step-num-3">💬</div>
            <h3>Match & Collaborate</h3>
            <p>A mutual like creates a Match. Open a private chat and start your academic collaboration.</p>
        </div>
    </div>
</section>

{{-- ── FEATURES ── --}}
<section class="pc-features-wrap pc-reveal">
    <div class="pc-features-header">
        <div class="pc-eyebrow" style="justify-content:center;display:inline-flex">Built for real academic connection</div>
        <h2>Everything you need, nothing you don't</h2>
    </div>
    <div class="pc-features-grid">
        <div class="pc-feature">
            <div class="pc-feature-icon" style="background:rgba(20,87,217,.2)">⚡</div>
            <h3>Swipe Deck</h3>
            <p>Tinder-style one-card discovery filtered automatically by your academic role. Students see teachers, teachers see students.</p>
        </div>
        <div class="pc-feature">
            <div class="pc-feature-icon" style="background:rgba(232,74,95,.2)">🤝</div>
            <h3>Mutual Matching</h3>
            <p>A match only forms when both sides like each other. Every connection is consensual and intentional.</p>
        </div>
        <div class="pc-feature">
            <div class="pc-feature-icon" style="background:rgba(15,139,141,.2)">💬</div>
            <h3>Private Chat</h3>
            <p>Every match unlocks a private chat room styled like iMessage. Hover over names to preview full profiles.</p>
        </div>
        <div class="pc-feature">
            <div class="pc-feature-icon" style="background:rgba(35,122,87,.2)">🔍</div>
            <h3>Profile Search</h3>
            <p>Browse all profiles with keyword search by name, department, or interest. Paginated for easy exploration.</p>
        </div>
        <div class="pc-feature">
            <div class="pc-feature-icon" style="background:rgba(217,119,6,.2)">🏷️</div>
            <h3>Interest Tags</h3>
            <p>Tag yourself with academic interests like Laravel, Data Analysis, UX Design, Machine Learning, and more.</p>
        </div>
        <div class="pc-feature">
            <div class="pc-feature-icon" style="background:rgba(124,58,237,.2)">🛡️</div>
            <h3>Admin Panel</h3>
            <p>Full platform oversight — user management, content moderation, reports review, and detailed access logs.</p>
        </div>
    </div>
</section>

{{-- ── STATS ── --}}
<section class="pc-stats pc-reveal">
    <div class="pc-stat">
        <strong>5</strong>
        <span>Related Eloquent Entities</span>
    </div>
    <div class="pc-stat">
        <strong>CRUD</strong>
        <span>Profiles · Interests · Connections · Messages</span>
    </div>
    <div class="pc-stat">
        <strong>MVC</strong>
        <span>Routes · Controllers · Models · Blade Views</span>
    </div>
    <div class="pc-stat">
        <strong>Laravel 12</strong>
        <span>PHP 8.2 · MariaDB · Vite · Eloquent ORM</span>
    </div>
</section>

{{-- ── CTA ── --}}
@guest
<section class="pc-cta-banner pc-reveal">
    <h2>Ready to find your academic match?</h2>
    <p>Join PeerConnect today — free, academic-focused, and built for real connections between students and teachers.</p>
    <div class="pc-cta-row-center">
        <a href="{{ route('register') }}" class="pc-btn-primary">Create Your Profile →</a>
        <a href="{{ route('profiles.index') }}" class="pc-btn-secondary">Browse Profiles First</a>
    </div>
</section>
@endguest

</div>

<script>
const reveals = document.querySelectorAll('.pc-reveal');
const observer = new IntersectionObserver(entries => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 120);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
reveals.forEach(el => observer.observe(el));
</script>

@endsection