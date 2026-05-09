@extends('layouts.app')

@section('title', $contactMessage->subject)

@section('content')
    <section class="section narrow">
        <div class="section-header">
            <div><p class="eyebrow">{{ $contactMessage->email }}</p><h1>{{ $contactMessage->subject }}</h1></div>
            <div class="actions">
                <x-button :href="route('contact-messages.edit', $contactMessage)" variant="secondary">Edit</x-button>
                <form method="POST" action="{{ route('contact-messages.destroy', $contactMessage) }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Delete</x-button>
                </form>
            </div>
        </div>
        <article class="detail-card">
            <p>{{ $contactMessage->message }}</p>
            <p>Status: {{ $contactMessage->is_resolved ? 'Resolved' : 'Open' }}</p>
        </article>
        <x-button :href="route('contact-messages.index')" variant="secondary">Back</x-button>
    </section>
@endsection
