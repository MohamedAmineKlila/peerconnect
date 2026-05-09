@extends('layouts.app')

@section('title', $profile->user->name)

@section('content')
    <section class="section narrow">
        <div class="section-header">
            <div>
                <p class="eyebrow">{{ ucfirst($profile->user->role) }} profile</p>
                <h1>{{ $profile->user->name }}</h1>
            </div>
            @if (! auth()->check() || auth()->id() === $profile->user_id)
                <div class="actions">
                    <x-button :href="route('profiles.edit', $profile)" variant="secondary">{{ auth()->check() ? 'Edit My Profile' : 'Edit' }}</x-button>
                    <form method="POST" action="{{ route('profiles.destroy', $profile) }}">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" variant="danger">Delete</x-button>
                    </form>
                </div>
            @endif
        </div>

        <article class="detail-card">
            <h2>{{ $profile->headline }}</h2>
            <p>{{ $profile->bio }}</p>
            <dl>
                <div><dt>Department</dt><dd>{{ $profile->department }}</dd></div>
                <div><dt>Level</dt><dd>{{ $profile->level ?? 'Not specified' }}</dd></div>
                <div><dt>Mentoring</dt><dd>{{ $profile->available_for_mentoring ? 'Available' : 'Not available' }}</dd></div>
            </dl>
            <div class="tags">
                @foreach ($profile->interests as $interest)
                    <span>{{ $interest->name }}</span>
                @endforeach
            </div>
        </article>

        @auth
            @if (auth()->id() !== $profile->user_id && auth()->user()->role !== 'admin' && $profile->user->role !== 'admin')
                <section class="report-panel">
                    <div>
                        <p class="eyebrow">Safety</p>
                        <h2>Report this account</h2>
                        <p>If this person is bullying, harassing, threatening, or otherwise making PeerConnect unsafe, send a report to the admin team.</p>
                    </div>
                    <form method="POST" action="{{ route('reports.store', $profile->user) }}" class="form">
                        @csrf
                        <label>
                            What happened?
                            <select name="category" required>
                                <option value="">Choose a reason</option>
                                @foreach ($reportCategories as $value => $label)
                                    <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            Details
                            <textarea name="details" rows="5" required placeholder="Describe what happened, including any message context if you can.">{{ old('details') }}</textarea>
                        </label>
                        <x-button type="submit" variant="danger">Submit Report</x-button>
                    </form>
                </section>
            @endif
        @endauth

        <x-button :href="route('profiles.index')" variant="secondary">Back</x-button>
    </section>
@endsection
