@extends('layouts.app')

@section('title', 'PeerConnect - Student Teacher Matching')

@section('content')
    <section class="hero">
        <div>
            <p class="eyebrow">Academic matching platform</p>
            <h1>PeerConnect</h1>
            <p class="hero-copy">A Tinder-like Laravel website where students and teachers swipe through academic profiles, like promising connections, match around shared interests, and start conversations.</p>
            <div class="actions">
                <x-button :href="route('profiles.index')">Browse Profiles</x-button>
                <x-button :href="route('dashboard')" variant="secondary">Student/Teacher Mode</x-button>
            </div>
        </div>
        <div class="hero-panel">
            <span>Student</span>
            <strong>Software Engineering project help</strong>
            <p>Matched with a teacher mentor in Web Programming.</p>
        </div>
    </section>

    <section class="stats-grid">
        <article><strong>5</strong><span>Related entities</span></article>
        <article><strong>CRUD</strong><span>Profiles, interests, connections, messages, contact</span></article>
        <article><strong>MVC</strong><span>Routes, controllers, Eloquent models, Blade views</span></article>
    </section>
@endsection
