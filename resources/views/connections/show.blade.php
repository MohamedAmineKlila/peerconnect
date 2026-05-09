@extends('layouts.app')

@section('title', 'Connection')

@section('content')
    <section class="section narrow">
        <div class="section-header">
            <div>
                <p class="eyebrow">{{ $connection->status }}</p>
                <h1>{{ $connection->sender->name }} + {{ $connection->receiver->name }}</h1>
            </div>
            <div class="actions">
                <x-button :href="route('connections.edit', $connection)" variant="secondary">Edit</x-button>
                <form method="POST" action="{{ route('connections.destroy', $connection) }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Delete</x-button>
                </form>
            </div>
        </div>
        <article class="detail-card">
            <p>{{ $connection->note ?? 'No note.' }}</p>
            <p>Matched at: {{ $connection->matched_at?->format('Y-m-d H:i') ?? 'Not matched yet' }}</p>
            <h2>Messages</h2>
            <div class="list">
                @forelse ($connection->messages as $message)
                    <a href="{{ route('messages.show', $message) }}">{{ $message->sender->name }}: {{ Str::limit($message->body, 70) }}</a>
                @empty
                    <p>No messages yet.</p>
                @endforelse
            </div>
        </article>
        <x-button :href="route('connections.index')" variant="secondary">Back</x-button>
    </section>
@endsection
