@extends('layouts.app')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Message CRUD</p>
        <h1>Create Message</h1>
        <form method="POST" action="{{ route('messages.store') }}" class="form">
            @csrf
            @include('messages.form')
            <x-button type="submit">Create</x-button>
        </form>
    </section>
@endsection
