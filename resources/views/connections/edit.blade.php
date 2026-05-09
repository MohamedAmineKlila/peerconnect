@extends('layouts.app')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Connection CRUD</p>
        <h1>Edit Connection</h1>
        <form method="POST" action="{{ route('connections.update', $connection) }}" class="form">
            @csrf
            @method('PUT')
            @include('connections.form')
            <x-button type="submit">Update</x-button>
        </form>
    </section>
@endsection
