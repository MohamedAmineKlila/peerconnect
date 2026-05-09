@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Account</p>
        <h1>Login</h1>
        <form method="POST" action="{{ route('login.store') }}" class="form">
            @csrf
            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <x-field-error name="email" />

            <label>Password
                <input type="password" name="password" required>
            </label>
            <x-field-error name="password" />

            <x-button type="submit">Login</x-button>
        </form>
        <p>New here? Create a student or teacher account and complete your profile.</p>
    </section>
@endsection
