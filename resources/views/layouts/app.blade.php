<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PeerConnect')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a class="brand" href="{{ route('home') }}">PeerConnect</a>
            <div class="nav-links">
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('contact') }}">Contact</a>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        <a href="{{ route('profiles.index') }}">Profiles</a>
                        <a href="{{ route('interests.index') }}">Interests</a>
                        <a href="{{ route('connections.index') }}">Connections</a>
                        <a href="{{ route('messages.index') }}">Messages</a>
                        <a href="{{ route('admin.reports.index') }}">Reports</a>
                        <a href="{{ route('contact-messages.index') }}">Contact Inbox</a>
                    @else
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('profiles.index') }}">Profiles</a>
                        <a class="notification-link" href="{{ route('dashboard') }}#likes">
                            Notifications
                            @if (($navIncomingLikesCount ?? 0) + ($navMatchesCount ?? 0) > 0)
                                <span>{{ ($navIncomingLikesCount ?? 0) + ($navMatchesCount ?? 0) }}</span>
                            @endif
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="nav-form">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="page">
        @auth
            @if (auth()->user()->role !== 'admin')
            <section class="notification-strip">
                <a href="{{ route('dashboard') }}#likes">
                    <strong>{{ $navIncomingLikesCount ?? 0 }}</strong>
                    new like{{ ($navIncomingLikesCount ?? 0) === 1 ? '' : 's' }}
                </a>
                <a href="{{ route('dashboard') }}#matches">
                    <strong>{{ $navMatchesCount ?? 0 }}</strong>
                    match{{ ($navMatchesCount ?? 0) === 1 ? '' : 'es' }}
                </a>
            </section>
            @endif
        @endauth

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if ($errors->any())
            <x-alert type="danger" message="Please correct the highlighted fields." />
            <div class="error-summary">
                <strong>What needs fixing:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
