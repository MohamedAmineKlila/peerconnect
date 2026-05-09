@extends('layouts.app')

@section('title', 'Message')

@section('content')
    <section class="section narrow">
        <div class="section-header">
            <div><p class="eyebrow">Message</p><h1>{{ $message->sender->name }}</h1></div>
            <div class="actions">
                <x-button :href="route('messages.edit', $message)" variant="secondary">Edit</x-button>
                <form method="POST" action="{{ route('messages.destroy', $message) }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Delete</x-button>
                </form>
            </div>
        </div>
        <article class="detail-card">
            <p>{{ $message->body }}</p>
            <p>Connection: {{ $message->connection->sender->name }} + {{ $message->connection->receiver->name }}</p>
            <p>Read at: {{ $message->read_at?->format('Y-m-d H:i') ?? 'Unread' }}</p>
        </article>
        <x-button :href="route('messages.index')" variant="secondary">Back</x-button>
    </section>
@endsection
