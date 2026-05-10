<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PeerConnect')</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <div class="nav-left">
                <a class="brand-pill" href="{{ route('home') }}">
                    <div class="brand-pill-dot"></div>
                    <span class="brand-pill-text">PeerConnect</span>
                </a>
            </div>

            <div class="nav-center">
                <a href="{{ route('home') }}" class="nav-pill {{ request()->routeIs('home') ? 'pill-active' : '' }}">
                    <span class="nav-pill-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 10.5 12 3l9 7.5"></path>
                            <path d="M5 10v11h14V10"></path>
                        </svg>
                    </span>
                    <span>Home</span>
                </a>
                <a href="{{ route('about') }}" class="nav-pill {{ request()->routeIs('about') ? 'pill-active' : '' }}">
                    <span class="nav-pill-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 16v-4"></path>
                            <path d="M12 8h.01"></path>
                        </svg>
                    </span>
                    <span>About</span>
                </a>
                <a href="{{ route('profiles.index') }}" class="nav-pill {{ request()->routeIs('profiles.*') ? 'pill-active' : '' }}">
                    <span class="nav-pill-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <path d="M20 8v6"></path>
                            <path d="M23 11h-6"></path>
                        </svg>
                    </span>
                    <span>Profiles</span>
                </a>
                <a href="{{ url('/games') }}" class="nav-pill {{ request()->is('games*') ? 'pill-active' : '' }}">
                    <span class="nav-pill-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 7h10a4 4 0 0 1 0 8H7a4 4 0 0 1 0-8Z"></path>
                            <path d="M8 15l-2 6"></path>
                            <path d="M16 15l2 6"></path>
                            <path d="M10 11h.01"></path>
                            <path d="M14 11h.01"></path>
                        </svg>
                    </span>
                    <span>Games</span>
                </a>
                <a href="{{ route('contact') }}" class="nav-pill {{ request()->routeIs('contact') ? 'pill-active' : '' }}">
                    <span class="nav-pill-icon">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16v16H4z"></path>
                            <path d="m22 6-10 7L2 6"></path>
                        </svg>
                    </span>
                    <span>Contact</span>
                </a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-pill {{ request()->routeIs('admin.*') ? 'pill-active' : '' }}">
                            <span class="nav-pill-icon">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2l2 7h7l-5.5 4 2 7-5.5-4-5.5 4 2-7L3 9h7l2-7z"></path>
                                </svg>
                            </span>
                            <span>Admin</span>
                        </a>
                    @endif
                @endauth
            </div>

            <div class="nav-right">
                <button class="icon-btn" id="themeToggle" title="Toggle theme">
                    <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <circle cx="12" cy="12" r="5"/>
                        <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                        <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                    <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                </button>

                @auth
                    <a href="{{ route('dashboard') }}#likes" class="icon-btn nav-notif-wrap" title="Notifications">
                        <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                        @if((($navIncomingLikesCount ?? 0) + ($navMatchesCount ?? 0)) > 0)
                            <span class="nav-notif-badge">{{ ($navIncomingLikesCount ?? 0) + ($navMatchesCount ?? 0) }}</span>
                        @endif
                    </a>

                    <a href="{{ route('dashboard') }}" class="avatar-btn" title="My account">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="nav-logout-form">
                        @csrf
                        <button type="submit" class="nav-pill pill-ghost nav-logout-btn">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-pill pill-ghost">Login</a>
                    <a href="{{ route('register') }}" class="nav-pill pill-primary">Get Started</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- AI Chat (floating) -->
    @auth
    <button id="aiChatFab" type="button" class="ai-fab" aria-label="Open AI chat" title="AI Chat">
        <div class="ai-fab-orbit"></div>
        <div class="ai-fab-robot">
            <svg viewBox="0 0 64 64" width="28" height="28" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="14" y="14" width="36" height="36" rx="10"></rect>
                <rect x="23" y="25" width="6" height="6" rx="2" fill="currentColor" stroke="none"></rect>
                <rect x="35" y="25" width="6" height="6" rx="2" fill="currentColor" stroke="none"></rect>
                <path d="M26 38h12"></path>
                <path d="M32 14v-6"></path>
                <path d="M22 50c-3 0-6 3-6 6"></path>
                <path d="M42 50c3 0 6 3 6 6"></path>
                <path d="M26 46l-4 10"></path>
                <path d="M38 46l4 10"></path>
                <path d="M20 32h-8"></path>
                <path d="M52 32h-8"></path>
                <path d="M32 32h0"></path>
            </svg>
        </div>
    </button>

    <div id="aiChatModal" class="ai-modal" role="dialog" aria-modal="true" aria-labelledby="aiChatTitle">
        <div class="ai-modal-panel">
            <div class="ai-modal-header">
                <div class="ai-modal-title">
                    <span class="ai-bot-badge">AI</span>
                    <h3 id="aiChatTitle">POPO</h3>
                </div>
                <button id="aiChatClose" type="button" class="ai-close" aria-label="Close AI chat">
                    ✕
                </button>
            </div>

            <div id="aiChatBody" class="ai-chat-body" aria-live="polite"></div>

            <form id="aiChatForm" class="ai-chat-form" autocomplete="off">
                <input
                    id="aiChatInput"
                    name="message"
                    type="text"
                    placeholder="Ask anything about learning…"
                    required
                />
                <button id="aiChatSend" type="submit" class="ai-send" aria-label="Send message">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 2 11 13"></path>
                        <path d="M22 2 15 22 11 13 2 9 22 2"></path>
                    </svg>
                </button>
            </form>
            <div class="ai-chat-hint">Tip: Ask “How do I study for Laravel?”</div>
        </div>
    </div>
    @endauth

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

    @auth
    <script>
        (function () {
            const fab = document.getElementById('aiChatFab');
            const modal = document.getElementById('aiChatModal');
            const closeBtn = document.getElementById('aiChatClose');
            const form = document.getElementById('aiChatForm');
            const input = document.getElementById('aiChatInput');
            const body = document.getElementById('aiChatBody');

            function openModal() {
                if (!modal) return;
                modal.classList.add('open');
                requestAnimationFrame(() => {
                    input?.focus?.();
                });
            }

            function closeModal() {
                if (!modal) return;
                modal.classList.remove('open');
            }

            function appendMsg({ who, text }) {
                const wrapper = document.createElement('div');
                wrapper.className = 'ai-msg' + (who === 'user' ? ' user' : '');
                const bubble = document.createElement('div');
                bubble.className = 'ai-bubble';

                // Safe rendering: textContent avoids HTML-breaking & JS parse errors
                const parts = String(text).split('\n');
                bubble.appendChild(document.createTextNode(parts.shift() || ''));
                parts.forEach((p) => {
                    bubble.appendChild(document.createElement('br'));
                    bubble.appendChild(document.createTextNode(p));
                });

                wrapper.appendChild(bubble);
                body.appendChild(wrapper);
                body.scrollTop = body.scrollHeight;
            }

            function appendTyping() {
                const t = document.createElement('div');
                t.className = 'ai-typing';
                t.id = 'aiTyping';
                t.innerHTML = '<span style="font-weight:900">AI is thinking</span><span class="ai-dots"><span class="ai-dot"></span><span class="ai-dot"></span><span class="ai-dot"></span></span>';
                body.appendChild(t);
                body.scrollTop = body.scrollHeight;
                return t;
            }

            function removeTyping() {
                const el = document.getElementById('aiTyping');
                el?.remove?.();
            }

            // Demo greeting
            if (body && body.childElementCount === 0) {
                const greet = document.createElement('div');
                greet.className = 'ai-msg';
                greet.innerHTML = '<div class="ai-bubble">Hi {{ auth()->user()->name }}, how can I help you today?</div>';
                body.appendChild(greet);
            }

            fab?.addEventListener('click', openModal);
            closeBtn?.addEventListener('click', closeModal);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            form?.addEventListener('submit', async (e) => {
                e.preventDefault();
                const msg = (input?.value || '').trim();
                if (!msg) return;
                input.value = '';

                appendMsg({ who: 'user', text: msg });

                const typing = appendTyping();

                try {
                    const res = await fetch('{{ route('ai-chat') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({ message: msg })
                    });

                    const data = await res.json();
                    const reply = data?.reply || 'No reply (mock).';
                    removeTyping();
                    appendMsg({ who: 'ai', text: reply });
                } catch (err) {
                    removeTyping();
                    appendMsg({ who: 'ai', text: 'Something went wrong. Please try again.' });
                }
            });
        })();
    </script>
    @endauth
</body>
</html>
