@extends('layouts.app')

@section('title', 'Connections')

@section('content')
    <section class="section">
        <div class="section-header">
            <div><p class="eyebrow">Matching</p><h1>Connections</h1></div>
            <x-button :href="route('connections.create')">New Connection</x-button>
        </div>
        <form class="search" method="GET">
            <input name="search" value="{{ $search }}" placeholder="Search status or person">
            <x-button type="submit" variant="secondary">Search</x-button>
        </form>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Sender</th><th>Receiver</th><th>Status</th><th>Matched</th><th></th></tr></thead>
                <tbody>
                @foreach ($connections as $connection)
                    <tr>
                        <td>{{ $connection->sender->name }}</td>
                        <td>{{ $connection->receiver->name }}</td>
                        <td><span class="status">{{ $connection->status }}</span></td>
                        <td>{{ $connection->matched_at?->format('Y-m-d') ?? '-' }}</td>
                        <td><a href="{{ route('connections.show', $connection) }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $connections->links() }}
    </section>
@endsection
