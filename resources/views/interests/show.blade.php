@extends('layouts.app')

@section('title', $interest->name)

@section('content')
    <section class="section narrow">
        <div class="section-header">
            <div>
                <p class="eyebrow">{{ $interest->category }}</p>
                <h1>{{ $interest->name }}</h1>
            </div>
            <div class="actions">
                <x-button :href="route('interests.edit', $interest)" variant="secondary">Edit</x-button>
                <form method="POST" action="{{ route('interests.destroy', $interest) }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Delete</x-button>
                </form>
            </div>
        </div>
        <p>{{ $interest->description ?? 'No description yet.' }}</p>
        <h2>Profiles</h2>
        <div class="list">
            @forelse ($interest->profiles as $profile)
                <a href="{{ route('profiles.show', $profile) }}">{{ $profile->user->name }} - {{ $profile->headline }}</a>
            @empty
                <p>No profiles use this interest yet.</p>
            @endforelse
        </div>
        <x-button :href="route('interests.index')" variant="secondary">Back</x-button>
    </section>
@endsection
