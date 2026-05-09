@extends('layouts.app')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Message CRUD</p>
        <h1>Edit Message</h1>
        <form method="POST" action="{{ route('messages.update', $message) }}" class="form">
            @csrf
            @method('PUT')
            @include('messages.form')
            <x-button type="submit">Update</x-button>
        </form>
    </section>
@endsection
