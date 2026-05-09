@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Account</p>
        <h1>Create Account</h1>
        <form method="POST" action="{{ route('register.store') }}" class="form">
            @csrf
            <label>Name
                <input name="name" value="{{ old('name') }}" required>
            </label>
            <x-field-error name="name" />

            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <x-field-error name="email" />

            <label>Role
                <select name="role" required>
                    <option value="student" @selected(old('role') === 'student')>Student</option>
                    <option value="teacher" @selected(old('role') === 'teacher')>Teacher</option>
                </select>
            </label>
            <x-field-error name="role" />

            <label>Password
                <input type="password" name="password" required>
            </label>
            <x-field-error name="password" />

            <label>Confirm Password
                <input type="password" name="password_confirmation" required>
            </label>

            <x-button type="submit">Register</x-button>
        </form>
    </section>
@endsection
