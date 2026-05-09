@extends('layouts.app')

@section('title', 'Profiles')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <p class="eyebrow">Discover</p>
                <h1>Profiles</h1>
            </div>
            <x-button :href="route('profiles.create')">New Profile</x-button>
        </div>

        <form class="search" method="GET">
            <input name="search" value="{{ $search }}" placeholder="Search by name, department, headline, or interest">
            <x-button type="submit" variant="secondary">Search</x-button>
        </form>

        <div class="card-grid">
            @forelse ($profiles as $profile)
                <article class="profile-card">
                    <div class="avatar">
                        @if ($profile->avatar_path)
                            <img src="{{ asset('storage/' . $profile->avatar_path) }}" alt="{{ $profile->user->name }}">
                        @else
                            <span>{{ strtoupper(substr($profile->user->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <p class="eyebrow">{{ ucfirst($profile->user->role) }} - {{ $profile->department }}</p>
                    <h2>{{ $profile->user->name }}</h2>
                    <p>{{ $profile->headline }}</p>
                    <div class="tags">
                        @foreach ($profile->interests->take(3) as $interest)
                            <span>{{ $interest->name }}</span>
                        @endforeach
                    </div>
                    <x-button :href="route('profiles.show', $profile)" variant="secondary">View Details</x-button>
                </article>
            @empty
                <p>No profiles found.</p>
            @endforelse
        </div>

        {{ $profiles->links() }}
    </section>
@endsection
