@extends('layouts.app')

@section('title', 'Report #' . $report->id)

@section('content')
    <section class="section narrow">
        <div class="section-header">
            <div>
                <p class="eyebrow">Safety Report</p>
                <h1>Report #{{ $report->id }}</h1>
            </div>
            <div class="actions">
                <x-button :href="route('admin.reports.index')" variant="secondary">Back</x-button>
                <form method="POST" action="{{ route('admin.reports.destroy', $report) }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Delete</x-button>
                </form>
            </div>
        </div>

        <article class="detail-card">
            <h2>{{ $categories[$report->category] ?? ucfirst($report->category) }}</h2>
            <dl>
                <div>
                    <dt>Reported account</dt>
                    <dd>
                        @if ($report->reported->profile)
                            <a href="{{ route('profiles.show', $report->reported->profile) }}">{{ $report->reported->name }}</a>
                        @else
                            {{ $report->reported->name }}
                        @endif
                    </dd>
                </div>
                <div><dt>Reported role</dt><dd>{{ ucfirst($report->reported->role) }}</dd></div>
                <div><dt>Reporter</dt><dd>{{ $report->reporter->name }}</dd></div>
                <div><dt>Status</dt><dd>{{ $statuses[$report->status] ?? ucfirst($report->status) }}</dd></div>
                <div><dt>Submitted</dt><dd>{{ $report->created_at?->format('Y-m-d H:i') }}</dd></div>
                <div><dt>Reviewed by</dt><dd>{{ $report->reviewer?->name ?? 'Not reviewed yet' }}</dd></div>
            </dl>
            <h3>Report details</h3>
            <p>{{ $report->details }}</p>
        </article>

        <section class="admin-panel">
            <div class="section-header compact">
                <div>
                    <p class="eyebrow">Admin Review</p>
                    <h2>Manage this report</h2>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.reports.update', $report) }}" class="form">
                @csrf
                @method('PUT')
                <label>
                    Status
                    <select name="status" required>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $report->status) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    Admin notes
                    <textarea name="admin_notes" rows="5" placeholder="Add actions taken, warnings issued, or why the report was dismissed.">{{ old('admin_notes', $report->admin_notes) }}</textarea>
                </label>
                <x-button type="submit">Save Review</x-button>
            </form>
        </section>
    </section>
@endsection
