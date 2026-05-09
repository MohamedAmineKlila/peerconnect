@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">{{ ($isPersonalProfile ?? false) ? ucfirst(auth()->user()->role) . ' experience' : 'Profile CRUD' }}</p>
        <h1>{{ ($isPersonalProfile ?? false) ? 'Edit My Profile' : 'Edit Profile' }}</h1>
        <form method="POST" action="{{ route('profiles.update', $profile) }}" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')
            @include('profiles.form')
            <x-button type="submit">Update</x-button>
        </form>
    </section>
@endsection
