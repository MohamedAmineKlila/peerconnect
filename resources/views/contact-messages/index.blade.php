@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
    <section class="section">
        <div class="section-header">
            <div><p class="eyebrow">Admin</p><h1>Contact Messages</h1></div>
            <x-button :href="route('contact')" variant="secondary">Public Form</x-button>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Resolved</th><th></th></tr></thead>
                <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->is_resolved ? 'Yes' : 'No' }}</td>
                        <td><a href="{{ route('contact-messages.show', $message) }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $messages->links() }}
    </section>
@endsection
