@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <p class="eyebrow">Admin</p>
                <h1>Dashboard</h1>
                <p>Monitor PeerConnect activity, manage platform data, and export access logs for review.</p>
            </div>
            <x-button :href="route('admin.access-logs.export')" variant="secondary">Export Access Logs CSV</x-button>
        </div>

        <div class="stats-grid">
            <article><strong>{{ $usersCount }}</strong><span>Total users</span></article>
            <article><strong>{{ $studentsCount }}</strong><span>Students</span></article>
            <article><strong>{{ $teachersCount }}</strong><span>Teachers</span></article>
            <article><strong>{{ $profilesCount }}</strong><span>Profiles</span></article>
            <article><strong>{{ $matchesCount }}</strong><span>Matches</span></article>
            <article><strong>{{ $likesCount }}</strong><span>Pending likes</span></article>
            <article><strong>{{ $messagesCount }}</strong><span>Messages</span></article>
            <article><strong>{{ $interestsCount }}</strong><span>Interests</span></article>
            <article><strong>{{ $pendingReportsCount }}</strong><span>Pending reports</span></article>
        </div>

        <div class="admin-grid">
            <section class="admin-panel">
                <div class="section-header compact">
                    <div>
                        <p class="eyebrow">Management</p>
                        <h2>Admin Actions</h2>
                    </div>
                </div>
                <div class="admin-actions">
                    <x-button :href="route('profiles.index')" variant="secondary">Manage Profiles</x-button>
                    <x-button :href="route('interests.index')" variant="secondary">Manage Interests</x-button>
                    <x-button :href="route('connections.index')" variant="secondary">Manage Connections</x-button>
                    <x-button :href="route('messages.index')" variant="secondary">Manage Messages</x-button>
                    <x-button :href="route('admin.reports.index')" variant="secondary">Manage Reports</x-button>
                    <x-button :href="route('contact-messages.index')" variant="secondary">Contact Messages</x-button>
                </div>
            </section>

            <section class="admin-panel">
                <p class="eyebrow">Safety</p>
                <h2>Recent Reports</h2>
                <div class="list">
                    @forelse ($recentReports as $report)
                        <a href="{{ route('admin.reports.show', $report) }}">
                            <strong>{{ $report->reported->name }}</strong>
                            <span>{{ ucfirst(str_replace('_', ' ', $report->category)) }} - {{ ucfirst($report->status) }} - reported by {{ $report->reporter->name }}</span>
                        </a>
                    @empty
                        <p>No reports yet.</p>
                    @endforelse
                </div>
            </section>
        </div>

        <div class="admin-grid">
            <section class="admin-panel">
                <p class="eyebrow">New Users</p>
                <h2>Recent Accounts</h2>
                <div class="list">
                    @forelse ($recentUsers as $user)
                        <a href="{{ $user->profile ? route('profiles.show', $user->profile) : route('profiles.create') }}">
                            <strong>{{ $user->name }}</strong>
                            <span>{{ ucfirst($user->role) }} - {{ $user->email }}</span>
                        </a>
                    @empty
                        <p>No users yet.</p>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="admin-panel">
            <div class="section-header compact">
                <div>
                    <p class="eyebrow">Security</p>
                    <h2>Recent Access Logs</h2>
                </div>
                <x-button :href="route('admin.access-logs.export')" variant="secondary">Download CSV</x-button>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Method</th>
                            <th>Path</th>
                            <th>Status</th>
                            <th>IP</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($recentLogs as $log)
                        <tr>
                            <td>{{ $log->user?->email ?? 'Guest' }}</td>
                            <td>{{ $log->method }}</td>
                            <td>{{ $log->path }}</td>
                            <td>{{ $log->status_code }}</td>
                            <td>{{ $log->ip_address }}</td>
                            <td>{{ $log->created_at?->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No access logs yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
