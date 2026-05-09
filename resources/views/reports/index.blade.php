@extends('layouts.app')

@section('title', 'Reports')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <p class="eyebrow">Safety</p>
                <h1>Reports</h1>
                <p>Review reports about bullying, harassment, threats, spam, and other safety concerns.</p>
            </div>
        </div>

        <form class="search report-filters" method="GET">
            <input name="search" value="{{ $search }}" placeholder="Search users or report details">
            <select name="status">
                <option value="">All statuses</option>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-button type="submit" variant="secondary">Filter</x-button>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Reported Account</th>
                        <th>Reporter</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td>
                            <strong>{{ $report->reported->name }}</strong><br>
                            <span>{{ ucfirst($report->reported->role) }} - {{ $report->reported->email }}</span>
                        </td>
                        <td>{{ $report->reporter->name }}</td>
                        <td>{{ $categories[$report->category] ?? ucfirst($report->category) }}</td>
                        <td><span class="status status-{{ $report->status }}">{{ $statuses[$report->status] ?? ucfirst($report->status) }}</span></td>
                        <td>{{ $report->created_at?->format('Y-m-d H:i') }}</td>
                        <td><x-button :href="route('admin.reports.show', $report)" variant="secondary">Review</x-button></td>
                    </tr>
                @empty
                    <tr><td colspan="6">No reports found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $reports->links() }}
    </section>
@endsection
