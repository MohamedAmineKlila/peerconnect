@extends('layouts.app')

@section('title', 'Messages')

@section('content')
    <section class="section">
        <div class="section-header">
            <div><p class="eyebrow">Conversation</p><h1>Messages</h1></div>
            <x-button :href="route('messages.create')">New Message</x-button>
        </div>
        <form class="search" method="GET">
            <input name="search" value="{{ $search }}" placeholder="Search message text">
            <x-button type="submit" variant="secondary">Search</x-button>
        </form>
        <div class="list">
            @foreach ($messages as $message)
                <a href="{{ route('messages.show', $message) }}">
                    <strong>{{ $message->sender->name }}</strong>
                    <span>{{ Str::limit($message->body, 100) }}</span>
                </a>
            @endforeach
        </div>
        {{ $messages->links() }}
    </section>
@endsection
