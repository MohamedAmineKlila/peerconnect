@extends('layouts.app')

@section('title', 'New Profile')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">{{ ($isPersonalProfile ?? false) ? ucfirst(auth()->user()->role) . ' experience' : 'Profile CRUD' }}</p>
        <h1>{{ ($isPersonalProfile ?? false) ? 'Complete My Profile' : 'Create Profile' }}</h1>
        <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data" class="form">
            @csrf
            @include('profiles.form')
            <x-button type="submit">Create</x-button>
        </form>
    </section>
@endsection
