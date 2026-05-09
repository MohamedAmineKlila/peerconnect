@extends('layouts.app')

@section('title', 'Interests')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <p class="eyebrow">Tags</p>
                <h1>Interests</h1>
            </div>
            <x-button :href="route('interests.create')">New Interest</x-button>
        </div>
        <form class="search" method="GET">
            <input name="search" value="{{ $search }}" placeholder="Search interest or category">
            <x-button type="submit" variant="secondary">Search</x-button>
        </form>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Name</th><th>Category</th><th>Profiles</th><th></th></tr></thead>
                <tbody>
                @foreach ($interests as $interest)
                    <tr>
                        <td>{{ $interest->name }}</td>
                        <td>{{ $interest->category }}</td>
                        <td>{{ $interest->profiles_count }}</td>
                        <td><a href="{{ route('interests.show', $interest) }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $interests->links() }}
    </section>
@endsection
