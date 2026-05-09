@extends('layouts.app')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Connection CRUD</p>
        <h1>Create Connection</h1>
        <form method="POST" action="{{ route('connections.store') }}" class="form">
            @csrf
            @include('connections.form')
            <x-button type="submit">Create</x-button>
        </form>
    </section>
@endsection
