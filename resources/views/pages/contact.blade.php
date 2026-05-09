@extends('layouts.app')

@section('title', 'Contact PeerConnect')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Contact</p>
        <h1>Send a message</h1>
        <form method="POST" action="{{ route('contact-messages.store') }}" class="form">
            @csrf
            @include('contact-messages.form')
            <x-button type="submit">Send</x-button>
        </form>
    </section>
@endsection
