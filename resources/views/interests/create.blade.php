@extends('layouts.app')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Interest CRUD</p>
        <h1>Create Interest</h1>
        <form method="POST" action="{{ route('interests.store') }}" class="form">
            @csrf
            @include('interests.form')
            <x-button type="submit">Create</x-button>
        </form>
    </section>
@endsection
