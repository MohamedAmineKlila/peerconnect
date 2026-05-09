@extends('layouts.app')

@section('content')
    <section class="section narrow">
        <p class="eyebrow">Contact CRUD</p>
        <h1>Edit Contact Message</h1>
        <form method="POST" action="{{ route('contact-messages.update', $contactMessage) }}" class="form">
            @csrf
            @method('PUT')
            @include('contact-messages.form')
            <label class="checkbox">
                <input type="checkbox" name="is_resolved" value="1" @checked(old('is_resolved', $contactMessage->is_resolved))>
                Resolved
            </label>
            <x-button type="submit">Update</x-button>
        </form>
    </section>
@endsection
