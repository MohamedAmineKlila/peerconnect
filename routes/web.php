<?php

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::view('/about', 'pages.about')->name('about');
Route::get('/games', function () {
    return view('pages.games');
})->name('games');

Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/ai-chat', function (\Illuminate\Http\Request $request) {
    $message = (string) $request->input('message', '');
    $lower = mb_strtolower(trim($message));

    $name = 'Popo the AI';

    // Basic greetings + simple commands (rules-based, no external AI)
    if ($lower === '' ) {
        return response()->json(['ok' => true, 'reply' => "Hi! I’m {$name}. What can I help you with today?" ]);
    }

    if (preg_match('/\b(hi|hello|hey|good\s*morning|good\s*afternoon|good\s*evening)\b/i', $lower)) {
        return response()->json(['ok' => true, 'reply' => "Hi {$request->user()->name}, welcome! I’m {$name}. How can I help you today?" ]);
    }

    // Help command
    if (in_array($lower, ['help', '/help', '?'], true)) {
        return response()->json([
            'ok' => true,
            'reply' => "Sure! I can do basic commands:\n- help\n- hello\n- who are you\n- time\n- commands\n- echo: <text>\n- commands: list available commands"
        ]);
    }

    // Commands list
    if (in_array($lower, ['commands', 'command', 'help commands'], true)) {
        return response()->json([
            'ok' => true,
            'reply' => "Available commands:\n- hello / hi\n- who are you\n- time\n- help\n- echo: <text>"
        ]);
    }

    // Who are you
    if (preg_match('/\bwho\s*are\s*you\b|\bwhat\s*are\s*you\b|\bwhoami\b/i', $lower)) {
        return response()->json(['ok' => true, 'reply' => "I’m {$name}. I can answer basic greetings and commands. Try: help" ]);
    }

    // Time
    if (preg_match('/\btime\b|\bwhat.*time\b/i', $lower)) {
        $now = now()->format('H:i');
        return response()->json(['ok' => true, 'reply' => "Current time is {$now} (server time)." ]);
    }

    // Echo
    if (str_starts_with($lower, 'echo:')) {
        $text = trim(substr($message, strpos($message, ':') + 1));
        return response()->json(['ok' => true, 'reply' => $text === '' ? "Nothing to echo 😄" : $text ]);
    }

    // Structured Laravel learning guide
    if (preg_match('/\bhow\b.{0,20}\b(study|learn|start|begin|get started)\b.{0,20}\blaravel\b|\blaravel\b.{0,20}\b(guide|tutorial|roadmap|steps?|course|learn)\b/i', $lower)) {
        return response()->json(['ok' => true, 'reply' =>
            "Here's your structured Laravel learning roadmap:\n\n" .
            "1️⃣  Prerequisites\n   → PHP 8+, Composer, basic OOP, HTML/CSS\n\n" .
            "2️⃣  Install Laravel\n   → composer create-project laravel/laravel my-app\n   → php artisan serve\n\n" .
            "3️⃣  Routing\n   → routes/web.php — Route::get(), Route::post()\n   → Named routes & route parameters\n\n" .
            "4️⃣  Controllers\n   → php artisan make:controller PageController\n   → Resource controllers: make:controller --resource\n\n" .
            "5️⃣  Blade Templates\n   → @extends, @section, @yield, @include\n   → Components: php artisan make:component\n\n" .
            "6️⃣  Eloquent ORM & Migrations\n   → php artisan make:model Post -m\n   → Relationships: hasMany, belongsTo, belongsToMany\n\n" .
            "7️⃣  Auth & Middleware\n   → Install Breeze: composer require laravel/breeze\n   → php artisan breeze:install\n\n" .
            "8️⃣  Validation & Forms\n   → $request->validate([...]) in controllers\n   → Form Request classes\n\n" .
            "9️⃣  APIs & JSON\n   → Route::apiResource(), return response()->json()\n   → Sanctum for API tokens\n\n" .
            "🔟  Testing & Deploy\n   → php artisan test (PHPUnit)\n   → .env, config:cache, queue:work\n\n" .
            "📚  Resources: laravel.com/docs · laracasts.com\n   Start with Laracasts 'Laravel From Scratch' series!"
        ]);
    }

    // Simple learning prompts (generic Laravel mention)
    if (preg_match('/\b(laravel|php|routing|eloquent|blade|migration)\b/i', $lower)) {
        return response()->json(['ok' => true, 'reply' => "Got it! Ask me something specific like:\n- \"How do I study for Laravel?\"\n- \"How do routes work?\"\n- \"What is Eloquent?\"\nI'll guide you step-by-step." ]);
    }

    if (preg_match('/\b(ml|machine\s*learning|neural|model|overfitting)\b/i', $lower)) {
        return response()->json(['ok' => true, 'reply' => "Nice! What’s your ML topic—classification, regression, or overfitting? I’ll help you with a clear explanation + example." ]);
    }

    if (preg_match('/\b(ux|ui|design|wireframe|usability)\b/i', $lower)) {
        return response()->json(['ok' => true, 'reply' => "Sure—what are you designing (app/website) and who’s the target user? I’ll suggest UX improvements." ]);
    }

    $user = $request->user();
    $meeting = \App\Models\Meeting::whereHas('connection', function ($query) use ($user) {
        $query->where('sender_id', $user->id)
              ->orWhere('receiver_id', $user->id);
    })->with('connection.sender', 'connection.receiver')->latest('scheduled_at')->first();

    // Determine the other person in the meeting
    $otherPerson = null;
    if ($meeting && $meeting->connection) {
        $conn = $meeting->connection;
        $otherPerson = $conn->sender_id === $user->id
            ? $conn->receiver->name ?? null
            : $conn->sender->name ?? null;
    }

    $meetingMemory = $meeting ? [
        'when'           => $meeting->scheduled_at ? $meeting->scheduled_at->format('F j, Y \a\t H:i') : null,
        'duration_hours' => $meeting->duration_hours ?: 'not specified',
        'subject'        => $meeting->subject ?: 'not specified',
        'online'         => $meeting->online ? 'online' : 'in person',
        'where'          => $meeting->location ?: 'not specified',
        'agenda'         => $meeting->agenda ?: 'not defined yet',
        'with'           => $otherPerson,
    ] : $request->session()->get('meeting_memory');

    if (preg_match('/\b(meeting|agenda|schedule|when|where|remember|hours|subject|online|in person|with who|who.*meeting|meeting.*who)\b/i', $lower)) {
        if ($meetingMemory) {
            $withLine = isset($meetingMemory['with']) && $meetingMemory['with']
                ? " with " . $meetingMemory['with'] . ","
                : "";
            return response()->json([
                'ok' => true,
                'reply' => "Yes, I remember your meeting! It is scheduled for " .
                    ($meetingMemory['when'] ?? 'soon') . $withLine . " " .
                    ($meetingMemory['online'] ?? 'online') . ", for " .
                    ($meetingMemory['duration_hours'] ?? 'unspecified duration') . " hours. " .
                    "Subject: " . ($meetingMemory['subject'] ?? 'not specified') . ". " .
                    "Location: " . ($meetingMemory['where'] ?? 'not specified') . ". " .
                    "Agenda: " . ($meetingMemory['agenda'] ?? 'not set yet') . "."
            ]);
        }

        return response()->json([
            'ok' => true,
            'reply' => "I don't have a scheduled meeting for you yet. Once both users accept, you can set the time, location, duration, subject, and agenda here in chat."
        ]);
    }

    // Fallback
    return response()->json([
        'ok' => true,
        'reply' => "I’m {$name}. I can handle basic commands + greetings. Type “help” to see what I can do. If you ask a learning question (Laravel/ML/UX), tell me the exact task."
    ]);
})->middleware('auth')->name('ai-chat');

Route::post('/connections/{connection}/meeting/accept', [\App\Http\Controllers\MeetingController::class, 'accept'])
    ->middleware('auth')
    ->name('meeting.accept');

Route::post('/connections/{connection}/meeting/schedule', [\App\Http\Controllers\MeetingController::class, 'schedule'])
    ->middleware('auth')
    ->name('meeting.schedule');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',                    [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/react/{profile}',   [DashboardController::class, 'react'])->name('dashboard.react');
    Route::post('/reports/{user}',              [ReportController::class, 'store'])->name('reports.store');

    // Chat between matched users
    Route::get('/chat/{connection}',            [MessageController::class, 'show'])->name('chat.show');
    Route::post('/chat/{connection}',           [MessageController::class, 'store'])->name('chat.store');

    Route::resource('profiles', ProfileController::class)->except(['index', 'show']);
});

Route::resource('profiles', ProfileController::class)->only(['index', 'show']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/access-logs/export', [AdminController::class, 'exportAccessLogs'])->name('admin.access-logs.export');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('reports', ReportController::class)->only(['index', 'show', 'update', 'destroy']);
    });
    Route::resource('interests',        InterestController::class);
    Route::resource('connections',      ConnectionController::class);
    Route::resource('messages',         MessageController::class);
    Route::resource('contact-messages', ContactMessageController::class)->except(['create', 'store']);
});

Route::post('/contact-messages', [ContactMessageController::class, 'store'])->name('contact-messages.store');
