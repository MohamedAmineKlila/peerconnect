@extends('layouts.app')

@section('title', 'Academic Games — PeerConnect')
@section('page-title', 'Games')

@section('content')
<style>
.games-hero {
    text-align: center;
    padding: 40px 0 50px;
}
.games-hero h1 {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 900;
    letter-spacing: -.03em;
    margin: 0 0 12px;
}
.games-hero h1 span {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.games-hero p { color: var(--muted); font-size: 1.05rem; max-width: 500px; margin: 0 auto 28px; }

.games-tabs {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 40px;
}
.games-tab {
    padding: 8px 20px;
    border-radius: 999px;
    border: 1.5px solid var(--border);
    background: var(--surface);
    color: var(--muted);
    font-weight: 700;
    font-size: .85rem;
    cursor: pointer;
    transition: all .2s;
}
.games-tab:hover, .games-tab.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 60px;
}

.game-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
}
.game-card:hover { transform: translateY(-6px); box-shadow: 0 20px 60px rgba(20,87,217,.15); }

.game-card-thumb {
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    position: relative;
    overflow: hidden;
}
.game-card-body { padding: 20px; }
.game-card-body h3 { margin: 0 0 8px; font-weight: 900; font-size: 1.1rem; }
.game-card-body p { color: var(--muted); font-size: .85rem; margin: 0 0 14px; line-height: 1.5; }
.game-card-meta { display: flex; align-items: center; justify-content: space-between; }
.game-tag { background: rgba(20,87,217,.1); color: var(--primary); border-radius: 999px; padding: 4px 10px; font-size: .72rem; font-weight: 700; }
.game-diff { font-size: .75rem; color: var(--muted); font-weight: 600; }

/* ── GAME MODAL ── */
.game-modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,.6); backdrop-filter: blur(8px);
    z-index: 1000; display: none; align-items: center; justify-content: center; padding: 20px;
}
.game-modal-overlay.open { display: flex; }
.game-modal {
    background: var(--surface); border-radius: 24px; width: 100%; max-width: 680px;
    max-height: 90vh; overflow-y: auto; position: relative;
    box-shadow: 0 40px 100px rgba(0,0,0,.3);
}
.game-modal-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 24px; border-bottom: 1px solid var(--border);
    position: sticky; top: 0; background: var(--surface); z-index: 1;
}
.game-modal-header h2 { margin: 0; font-size: 1.2rem; font-weight: 900; }
.game-modal-close { width: 36px; height: 36px; border-radius: 50%; border: 1.5px solid var(--border); background: var(--surface2); cursor: pointer; font-size: 1rem; display: grid; place-items: center; }
.game-modal-body { padding: 24px; }

/* ── QUIZ GAME ── */
.quiz-q { font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; line-height: 1.5; }
.quiz-options { display: grid; gap: 10px; }
.quiz-opt {
    padding: 14px 18px; border-radius: 12px; border: 1.5px solid var(--border);
    background: var(--surface2); cursor: pointer; font-weight: 600; font-size: .9rem;
    transition: all .2s; text-align: left;
}
.quiz-opt:hover { border-color: var(--primary); color: var(--primary); }
.quiz-opt.correct { border-color: #237a57; background: #eaf8f1; color: #237a57; }
.quiz-opt.wrong { border-color: #d92d20; background: #fff0f0; color: #d92d20; }
[data-theme="dark"] .quiz-opt.correct { background: rgba(63,185,80,.12); }
[data-theme="dark"] .quiz-opt.wrong { background: rgba(248,81,73,.12); }

.quiz-score { text-align: center; padding: 20px 0; }
.quiz-score-num { font-size: 3rem; font-weight: 900; color: var(--primary); }
.quiz-nav { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
.quiz-progress { font-size: .82rem; color: var(--muted); font-weight: 600; }

/* ── MEMORY GAME ── */
.memory-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px; }
.mem-card {
    aspect-ratio: 1; border-radius: 10px; border: 1.5px solid var(--border);
    background: var(--primary); cursor: pointer; display: grid; place-items: center;
    font-size: 1.6rem; transition: transform .2s; user-select: none;
}
.mem-card.flipped { background: var(--surface2); }
.mem-card.matched { background: #eaf8f1; border-color: #237a57; pointer-events: none; }
[data-theme="dark"] .mem-card.matched { background: rgba(63,185,80,.12); }
.mem-card:not(.flipped):not(.matched) { font-size: 0; }
.mem-score-row { display: flex; gap: 20px; justify-content: center; color: var(--muted); font-weight: 700; font-size: .88rem; }

/* ── CODE FILL GAME ── */
.code-block {
    background: var(--surface2); border: 1px solid var(--border); border-radius: 12px;
    padding: 20px; font-family: 'Courier New', monospace; font-size: .9rem;
    line-height: 1.8; margin-bottom: 16px; color: var(--ink);
}
.code-blank {
    display: inline-block; border-bottom: 2px solid var(--primary);
    min-width: 80px; background: rgba(20,87,217,.08); border-radius: 4px;
    padding: 0 6px; color: var(--primary); font-weight: 700; cursor: text;
}
.code-blank:focus { outline: none; box-shadow: 0 0 0 2px rgba(20,87,217,.2); }
.code-choices { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
.code-choice {
    background: var(--surface2); border: 1.5px solid var(--border); border-radius: 8px;
    padding: 6px 14px; cursor: pointer; font-family: monospace; font-size: .85rem;
    font-weight: 700; transition: all .2s;
}
.code-choice:hover { border-color: var(--primary); color: var(--primary); }
.code-choice.used { opacity: .4; pointer-events: none; }
</style>

{{-- HERO --}}
<div class="games-hero">
    <h1>🎮 Learn by <span>Playing</span></h1>
    <p>Test your knowledge in Laravel, Data Analysis, Machine Learning, UX Design, and more — through fun interactive games.</p>
</div>

{{-- TABS --}}
<div class="games-tabs">
    <button class="games-tab active" data-filter="all">All Games</button>
    <button class="games-tab" data-filter="laravel">Laravel</button>
    <button class="games-tab" data-filter="ml">Machine Learning</button>
    <button class="games-tab" data-filter="ux">UX Design</button>
    <button class="games-tab" data-filter="data">Data Analysis</button>
</div>

{{-- GAME CARDS --}}
<div class="games-grid">

    <div class="game-card" data-category="laravel" data-game="quiz-laravel" onclick="openGame('quiz-laravel')">
        <div class="game-card-thumb" style="background:linear-gradient(135deg,#ff2d20,#ff6b55)">🔥</div>
        <div class="game-card-body">
            <h3>Laravel Quiz</h3>
            <p>Test your knowledge of Laravel routing, Eloquent ORM, Blade templates, and MVC architecture.</p>
            <div class="game-card-meta">
                <span class="game-tag">Laravel</span>
                <span class="game-diff">⭐⭐ Medium</span>
            </div>
        </div>
    </div>

    <div class="game-card" data-category="laravel" data-game="code-fill" onclick="openGame('code-fill')">
        <div class="game-card-thumb" style="background:linear-gradient(135deg,#1457d9,#3b82f6)">💻</div>
        <div class="game-card-body">
            <h3>Fill the Code</h3>
            <p>Complete missing parts of Laravel code snippets — routes, models, controllers, and migrations.</p>
            <div class="game-card-meta">
                <span class="game-tag">Laravel</span>
                <span class="game-diff">⭐⭐⭐ Hard</span>
            </div>
        </div>
    </div>

    <div class="game-card" data-category="ml" data-game="quiz-ml" onclick="openGame('quiz-ml')">
        <div class="game-card-thumb" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)">🤖</div>
        <div class="game-card-body">
            <h3>ML Concepts Quiz</h3>
            <p>How well do you know supervised learning, neural networks, overfitting, and model evaluation?</p>
            <div class="game-card-meta">
                <span class="game-tag">Machine Learning</span>
                <span class="game-diff">⭐⭐ Medium</span>
            </div>
        </div>
    </div>

    <div class="game-card" data-category="ux" data-game="memory-ux" onclick="openGame('memory-ux')">
        <div class="game-card-thumb" style="background:linear-gradient(135deg,#e84a5f,#fca5a5)">🎨</div>
        <div class="game-card-body">
            <h3>UX Principles Memory</h3>
            <p>Match UX design principles with their definitions in this card-flipping memory game.</p>
            <div class="game-card-meta">
                <span class="game-tag">UX Design</span>
                <span class="game-diff">⭐ Easy</span>
            </div>
        </div>
    </div>

    <div class="game-card" data-category="data" data-game="quiz-data" onclick="openGame('quiz-data')">
        <div class="game-card-thumb" style="background:linear-gradient(135deg,#0f8b8d,#34d399)">📊</div>
        <div class="game-card-body">
            <h3>Data Analysis Quiz</h3>
            <p>SQL queries, data cleaning, visualization types, and statistical concepts — how much do you know?</p>
            <div class="game-card-meta">
                <span class="game-tag">Data Analysis</span>
                <span class="game-diff">⭐⭐ Medium</span>
            </div>
        </div>
    </div>

    <div class="game-card" data-category="laravel" data-game="quiz-pm" onclick="openGame('quiz-pm')">
        <div class="game-card-thumb" style="background:linear-gradient(135deg,#d97706,#fbbf24)">📋</div>
        <div class="game-card-body">
            <h3>Project Management Quiz</h3>
            <p>Agile, Scrum, sprints, stakeholders, and Git workflows — test your PM knowledge.</p>
            <div class="game-card-meta">
                <span class="game-tag">Project Management</span>
                <span class="game-diff">⭐ Easy</span>
            </div>
        </div>
    </div>

</div>

{{-- ══ GAME MODAL ══ --}}
<div class="game-modal-overlay" id="gameModal">
    <div class="game-modal">
        <div class="game-modal-header">
            <h2 id="gameModalTitle">Game</h2>
            <button class="game-modal-close" onclick="closeGame()">✕</button>
        </div>
        <div class="game-modal-body" id="gameModalBody"></div>
    </div>
</div>

<script>
// ── GAME DATA ──────────────────────────────────────
const GAMES = {
    'quiz-laravel': {
        title: '🔥 Laravel Quiz',
        type: 'quiz',
        questions: [
            { q: "What Artisan command creates a new controller?", options: ["php artisan make:model", "php artisan make:controller", "php artisan new:controller", "php artisan create:controller"], a: 1 },
            { q: "In Eloquent, which method retrieves all records from a table?", options: ["find()", "first()", "all()", "get()"], a: 2 },
            { q: "What does CSRF stand for in Laravel?", options: ["Cross-Site Request Forgery", "Cross-Site Resource Fetch", "Client-Side Request Filter", "Core Server Request File"], a: 0 },
            { q: "Which file defines Laravel application routes for the web?", options: ["app/routes.php", "routes/api.php", "routes/web.php", "config/routes.php"], a: 2 },
            { q: "What method is used to define a one-to-many relationship?", options: ["belongsTo()", "hasMany()", "hasOne()", "belongsToMany()"], a: 1 },
{ q: "Which Blade directive is used to output escaped content?", options: ["@{{ }}", "@{!! !!}", "@output", "@echo"], a: 0 },            { q: "What does 'php artisan migrate:fresh' do?", options: ["Runs only new migrations", "Drops all tables and reruns all migrations", "Refreshes the database connection", "Creates a new migration file"], a: 1 },
            { q: "What is the default database driver in a fresh Laravel installation?", options: ["PostgreSQL", "MongoDB", "SQLite", "MySQL"], a: 2 },
        ]
    },
    'quiz-ml': {
        title: '🤖 Machine Learning Quiz',
        type: 'quiz',
        questions: [
            { q: "What is overfitting in machine learning?", options: ["Model performs well on training but poorly on new data", "Model is too simple to capture patterns", "Model takes too long to train", "Model has too few parameters"], a: 0 },
            { q: "Which algorithm is used for classification tasks?", options: ["Linear Regression", "K-Means Clustering", "Logistic Regression", "PCA"], a: 2 },
            { q: "What does 'epoch' mean in neural network training?", options: ["A single layer in the network", "One complete pass through the training data", "The learning rate value", "The number of neurons"], a: 1 },
            { q: "What is the purpose of a validation set?", options: ["To train the model", "To tune hyperparameters without touching test data", "To replace the test set", "To clean the data"], a: 1 },
            { q: "Which metric is best for imbalanced classification datasets?", options: ["Accuracy", "F1 Score", "Mean Squared Error", "R-squared"], a: 1 },
            { q: "What does 'K' represent in K-Nearest Neighbors?", options: ["The kernel size", "The number of nearest data points considered", "The learning rate", "The number of classes"], a: 1 },
        ]
    },
    'quiz-data': {
        title: '📊 Data Analysis Quiz',
        type: 'quiz',
        questions: [
            { q: "Which SQL clause filters rows after GROUP BY?", options: ["WHERE", "HAVING", "FILTER", "AND"], a: 1 },
            { q: "What does a box plot show?", options: ["Bar chart data", "Distribution, median, and outliers", "Correlation between two variables", "Time series trends"], a: 1 },
            { q: "What is data normalization?", options: ["Removing null values", "Scaling data to a standard range", "Sorting rows alphabetically", "Splitting data into train/test sets"], a: 1 },
            { q: "Which chart best shows parts of a whole?", options: ["Line chart", "Scatter plot", "Pie chart", "Histogram"], a: 2 },
            { q: "What does SQL JOIN do?", options: ["Deletes rows from two tables", "Combines rows from two or more tables", "Creates a new table", "Adds a column"], a: 1 },
            { q: "What is a null value in a dataset?", options: ["A value of zero", "An empty or missing value", "A negative number", "An outlier"], a: 1 },
        ]
    },
    'quiz-pm': {
        title: '📋 Project Management Quiz',
        type: 'quiz',
        questions: [
            { q: "In Scrum, what is a Sprint?", options: ["A project planning document", "A fixed time-box for development work", "A type of Git branch", "A release version"], a: 1 },
            { q: "What does a Kanban board visualize?", options: ["Gantt chart timeline", "Workflow and task status", "Budget allocation", "Team salaries"], a: 1 },
            { q: "Which Git command merges a branch into the current branch?", options: ["git commit", "git push", "git merge", "git fetch"], a: 2 },
            { q: "What is a user story in Agile?", options: ["A bug report", "A technical specification", "A short description of a feature from the user's perspective", "A deployment checklist"], a: 2 },
            { q: "What does CI/CD stand for?", options: ["Continuous Integration / Continuous Delivery", "Code Inspection / Code Deployment", "Controlled Input / Controlled Database", "Central Interface / Central Dashboard"], a: 0 },
        ]
    },
    'memory-ux': {
        title: '🎨 UX Principles Memory',
        type: 'memory',
        pairs: [
            ['👁️ Visibility', '👁️ Visibility'], ['🎯 Affordance', '🎯 Affordance'],
            ['🔄 Feedback', '🔄 Feedback'], ['📐 Consistency', '📐 Consistency'],
            ['❌ Error Prevention', '❌ Error Prevention'], ['⚡ Efficiency', '⚡ Efficiency'],
            ['🧩 Simplicity', '🧩 Simplicity'], ['🗺️ Navigation', '🗺️ Navigation'],
        ]
    },
    'code-fill': {
        title: '💻 Fill the Code',
        type: 'codefill',
        exercises: [
            {
                description: "Define a route that responds to GET requests at /dashboard:",
                code: `Route::___('/ dashboard', [DashboardController::class, '___']);`,
                blanks: ['get', 'index'],
                choices: ['get', 'post', 'index', 'show', 'store', 'put'],
                hint: "Use Route::get() and the index method"
            },
            {
                description: "Define a hasMany relationship in a Model:",
                code: `public function messages(): ___\n{\n    return $this->___( Message::class);\n}`,
                blanks: ['HasMany', 'hasMany'],
                choices: ['HasMany', 'BelongsTo', 'hasMany', 'belongsTo', 'HasOne', 'hasOne'],
                hint: "One connection has many messages"
            },
            {
                description: "Validate a required email field in a controller:",
                code: `$request->___([\n    'email' => '___| email |unique:users',\n]);`,
                blanks: ['validate', 'required'],
                choices: ['validate', 'check', 'required', 'nullable', 'sanitize', 'verify'],
                hint: "Use validate() method with required|email"
            }
        ]
    }
};

let currentGame = null;
let quizIdx = 0;
let quizScore = 0;
let memFlipped = [];
let memMatched = 0;
let memMoves = 0;
let codeExIdx = 0;

function openGame(id) {
    currentGame = GAMES[id];
    if (!currentGame) return;
    document.getElementById('gameModalTitle').textContent = currentGame.title;
    document.getElementById('gameModal').classList.add('open');
    renderGame();
}

function closeGame() {
    document.getElementById('gameModal').classList.remove('open');
    currentGame = null;
}

document.getElementById('gameModal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('gameModal')) closeGame();
});

function renderGame() {
    const body = document.getElementById('gameModalBody');
    if (!currentGame) return;
    if (currentGame.type === 'quiz') renderQuiz(body);
    else if (currentGame.type === 'memory') renderMemory(body);
    else if (currentGame.type === 'codefill') renderCodeFill(body);
}

// ── QUIZ ──
function renderQuiz(body) {
    quizIdx = 0; quizScore = 0;
    showQuestion(body);
}

function showQuestion(body) {
    const q = currentGame.questions[quizIdx];
    if (!q) {
        body.innerHTML = `
            <div class="quiz-score">
                <div style="font-size:3rem;margin-bottom:10px">${quizScore === currentGame.questions.length ? '🏆' : quizScore > currentGame.questions.length/2 ? '🎉' : '💪'}</div>
                <div class="quiz-score-num">${quizScore}/${currentGame.questions.length}</div>
                <p style="color:var(--muted);margin:8px 0 24px">${quizScore === currentGame.questions.length ? 'Perfect score! You are amazing! 🌟' : quizScore > currentGame.questions.length/2 ? 'Great job! Keep studying! 💪' : 'Keep practicing — you\'ve got this! 📚'}</p>
                <button class="btn btn-primary" onclick="renderQuiz(document.getElementById('gameModalBody'))">Play Again</button>
            </div>`;
        return;
    }
    body.innerHTML = `
        <div class="quiz-nav" style="margin-bottom:16px">
            <span class="quiz-progress">Question ${quizIdx + 1} of ${currentGame.questions.length}</span>
            <span style="color:var(--primary);font-weight:800">Score: ${quizScore}</span>
        </div>
        <div style="background:var(--surface2);border-radius:8px;height:6px;margin-bottom:20px">
            <div style="background:var(--primary);height:100%;border-radius:8px;width:${(quizIdx/currentGame.questions.length)*100}%;transition:width .3s"></div>
        </div>
        <div class="quiz-q">${q.q}</div>
        <div class="quiz-options">
            ${q.options.map((opt, i) => `<button class="quiz-opt" onclick="answerQuiz(${i})">${opt}</button>`).join('')}
        </div>`;
}

function answerQuiz(chosen) {
    const q = currentGame.questions[quizIdx];
    const opts = document.querySelectorAll('.quiz-opt');
    opts.forEach(o => o.style.pointerEvents = 'none');
    opts[q.a].classList.add('correct');
    if (chosen !== q.a) opts[chosen].classList.add('wrong');
    else quizScore++;
    setTimeout(() => { quizIdx++; showQuestion(document.getElementById('gameModalBody')); }, 900);
}

// ── MEMORY ──
function renderMemory(body) {
    memFlipped = []; memMatched = 0; memMoves = 0;
    const pairs = [...currentGame.pairs].sort(() => Math.random() - .5);
    body.innerHTML = `
        <div class="mem-score-row" style="margin-bottom:16px">
            <span>Moves: <strong id="memMoves">0</strong></span>
            <span>Matched: <strong id="memMatched">0</strong>/${pairs.length/2}</span>
        </div>
        <div class="memory-grid" id="memGrid">
            ${pairs.map((p, i) => `<div class="mem-card" data-val="${p}" data-idx="${i}" onclick="flipCard(this)">${p}</div>`).join('')}
        </div>`;
}

function flipCard(card) {
    if (card.classList.contains('flipped') || card.classList.contains('matched') || memFlipped.length === 2) return;
    card.classList.add('flipped');
    memFlipped.push(card);
    if (memFlipped.length === 2) {
        memMoves++;
        document.getElementById('memMoves').textContent = memMoves;
        if (memFlipped[0].dataset.val === memFlipped[1].dataset.val) {
            memFlipped.forEach(c => c.classList.add('matched'));
            memFlipped = []; memMatched++;
            document.getElementById('memMatched').textContent = memMatched;
            if (memMatched === currentGame.pairs.length / 2) {
                setTimeout(() => {
                    document.getElementById('gameModalBody').innerHTML += `<div style="text-align:center;padding:20px"><h3>🏆 You won in ${memMoves} moves!</h3><button class="btn btn-primary" onclick="renderMemory(document.getElementById('gameModalBody'))">Play Again</button></div>`;
                }, 300);
            }
        } else {
            setTimeout(() => { memFlipped.forEach(c => c.classList.remove('flipped')); memFlipped = []; }, 900);
        }
    }
}

// ── CODE FILL ──
function renderCodeFill(body) {
    codeExIdx = 0;
    showCodeEx(body);
}

function showCodeEx(body) {
    const ex = currentGame.exercises[codeExIdx];
    if (!ex) {
        body.innerHTML = `<div style="text-align:center;padding:30px"><div style="font-size:3rem">🎉</div><h3>All done!</h3><p style="color:var(--muted)">You completed all code exercises!</p><button class="btn btn-primary" onclick="renderCodeFill(document.getElementById('gameModalBody'))">Restart</button></div>`;
        return;
    }
    let codeHtml = ex.code;
    ex.blanks.forEach((b, i) => {
        codeHtml = codeHtml.replace('___', `<span class="code-blank" contenteditable="true" data-answer="${b}" data-idx="${i}" spellcheck="false"></span>`);
    });
    body.innerHTML = `
        <div style="margin-bottom:6px;color:var(--muted);font-size:.8rem">Exercise ${codeExIdx+1} of ${currentGame.exercises.length}</div>
        <p style="font-weight:700;margin:0 0 14px">${ex.description}</p>
        <div class="code-block">${codeHtml}</div>
        <p style="font-size:.8rem;color:var(--muted);margin:0 0 16px">💡 ${ex.hint}</p>
        <div style="display:flex;gap:10px">
            <button class="btn btn-primary" onclick="checkCode()">Check ✓</button>
            <button class="btn btn-secondary" onclick="nextCodeEx()">Skip →</button>
        </div>
        <div id="codeFeedback" style="margin-top:14px"></div>`;
}

function checkCode() {
    const blanks = document.querySelectorAll('.code-blank');
    let allCorrect = true;
    blanks.forEach(b => {
        const val = b.textContent.trim();
        if (val.toLowerCase() === b.dataset.answer.toLowerCase()) {
            b.style.borderColor = '#237a57'; b.style.color = '#237a57';
        } else {
            b.style.borderColor = '#d92d20'; b.style.color = '#d92d20';
            allCorrect = false;
        }
    });
    const fb = document.getElementById('codeFeedback');
    if (allCorrect) {
        fb.innerHTML = `<div style="color:#237a57;font-weight:700">✅ Perfect! Moving to next...</div>`;
        setTimeout(() => { codeExIdx++; showCodeEx(document.getElementById('gameModalBody')); }, 1000);
    } else {
        fb.innerHTML = `<div style="color:#d92d20;font-weight:700">❌ Some answers are wrong. Check the highlighted blanks.</div>`;
    }
}

function nextCodeEx() { codeExIdx++; showCodeEx(document.getElementById('gameModalBody')); }

// ── FILTER TABS ──
document.querySelectorAll('.games-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.games-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const filter = tab.dataset.filter;
        document.querySelectorAll('.game-card').forEach(card => {
            card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
        });
    });
});
</script>
@endsection
