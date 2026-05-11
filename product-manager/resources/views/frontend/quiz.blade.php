@extends('layouts.frontend')
@section('title', 'Offline/Online Quiz — Edu')

@section('styles')
<style>
    .quiz-container { max-width: 800px; margin: 0 auto; background: var(--card); border: 1px solid var(--border); border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,.05); padding: 40px; display: none; }
    .quiz-container.active { display: block; animation: fadeInUp .5s ease; }
    .option-btn { width: 100%; text-align: left; padding: 16px 20px; margin-bottom: 12px; background: var(--surface); border: 1px solid var(--border); border-radius: 10px; cursor: pointer; font-size: 15px; transition: all .2s; font-family: 'Inter', sans-serif; color: var(--text); }
    .option-btn:hover { border-color: var(--accent); background: rgba(0,0,0,.02); }
    .option-btn.selected { background: var(--accent); color: white; border-color: var(--accent); }
    .option-btn.correct { background: var(--green); color: white; border-color: var(--green); }
    .option-btn.wrong { background: #ef4444; color: white; border-color: #ef4444; }
    
    .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: rgba(16,185,129,.1); color: var(--green); border-radius: 20px; font-size: 12px; font-weight: 700; margin-bottom: 20px; }
    .status-badge.offline { background: rgba(245,158,11,.1); color: var(--orange); }
</style>
@endsection

@section('content')
<section style="padding: 120px 5% 80px; min-height: 80vh;">
    
    <!-- Welcome Screen -->
    <div id="quiz-welcome" class="quiz-container active" style="text-align: center;">
        <div id="network-status" class="status-badge">
            <i class="fas fa-wifi"></i> Online Mode Active
        </div>
        <i class="fas fa-brain" style="font-size: 64px; color: var(--accent); margin-bottom: 24px;"></i>
        <h1 style="font-size: 32px; font-weight: 800; margin-bottom: 16px;">Test Your Knowledge</h1>
        <p style="color: var(--muted); line-height: 1.7; margin-bottom: 32px; max-width: 500px; margin-left: auto; margin-right: auto;">
            Our interactive quiz works both online and offline. Your progress is saved locally. Ready to challenge yourself?
        </p>
        <button onclick="startQuiz()" class="btn-hero btn-hero-primary" style="font-size: 16px; padding: 14px 32px;">
            <i class="fas fa-play"></i> Start Quiz Now
        </button>
        <div id="last-score" style="margin-top: 24px; font-size: 14px; color: var(--muted); display: none;"></div>
    </div>

    <!-- Question Screen -->
    <div id="quiz-question" class="quiz-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <span style="font-size: 14px; font-weight: 600; color: var(--muted);">Question <span id="q-current">1</span> of <span id="q-total">5</span></span>
            <span id="q-timer" style="font-size: 14px; font-weight: 700; color: var(--accent);"><i class="fas fa-clock"></i> 00:00</span>
        </div>
        <div style="width: 100%; height: 6px; background: var(--surface); border-radius: 3px; margin-bottom: 32px; overflow: hidden;">
            <div id="q-progress" style="height: 100%; background: var(--accent); width: 20%; transition: width .3s;"></div>
        </div>
        
        <h2 id="question-text" style="font-size: 24px; font-weight: 700; margin-bottom: 32px; line-height: 1.4;"></h2>
        
        <div id="options-container">
            <!-- Options injected by JS -->
        </div>

        <div style="margin-top: 32px; text-align: right; display: none;" id="next-btn-container">
            <button onclick="nextQuestion()" class="btn-hero btn-hero-primary">Next Question <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <!-- Result Screen -->
    <div id="quiz-result" class="quiz-container" style="text-align: center;">
        <i class="fas fa-trophy" style="font-size: 64px; color: var(--orange); margin-bottom: 24px;"></i>
        <h2 style="font-size: 32px; font-weight: 800; margin-bottom: 8px;">Quiz Completed!</h2>
        <p style="color: var(--muted); margin-bottom: 32px;">Here is how you performed.</p>
        
        <div style="display: flex; justify-content: center; gap: 40px; margin-bottom: 40px;">
            <div>
                <div style="font-size: 48px; font-weight: 900; color: var(--text);" id="score-text">0</div>
                <div style="font-size: 13px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Final Score</div>
            </div>
            <div>
                <div style="font-size: 48px; font-weight: 900; color: var(--green);" id="correct-text">0</div>
                <div style="font-size: 13px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Correct Answers</div>
            </div>
        </div>

        <button onclick="resetQuiz()" class="btn-hero btn-hero-primary"><i class="fas fa-redo"></i> Retake Quiz</button>
        <a href="{{ route('courses') }}" class="btn-hero btn-hero-ghost"><i class="fas fa-book"></i> Back to Courses</a>
    </div>

</section>

@endsection

@section('scripts')
<script>
    // Offline/Online Detection
    function updateNetworkStatus() {
        const badge = document.getElementById('network-status');
        if(navigator.onLine) {
            badge.className = 'status-badge';
            badge.innerHTML = '<i class="fas fa-wifi"></i> Online Mode Active';
        } else {
            badge.className = 'status-badge offline';
            badge.innerHTML = '<i class="fas fa-plane"></i> Offline Mode Active';
        }
    }
    window.addEventListener('online', updateNetworkStatus);
    window.addEventListener('offline', updateNetworkStatus);
    updateNetworkStatus();

    // Check Previous Score
    const savedScore = localStorage.getItem('edu_quiz_score');
    if(savedScore) {
        document.getElementById('last-score').style.display = 'block';
        document.getElementById('last-score').innerText = `Last attempt score: ${savedScore}%`;
    }

    // Quiz Data
    const questions = [
        {
            q: "Which programming language is known as the language of the web?",
            options: ["Python", "JavaScript", "C++", "Java"],
            answer: 1
        },
        {
            q: "What does CSS stand for?",
            options: ["Computer Style Sheets", "Creative Style System", "Cascading Style Sheets", "Colorful Style Sheets"],
            answer: 2
        },
        {
            q: "In UI/UX design, what does 'UX' stand for?",
            options: ["User Exchange", "Universal Experience", "User Experience", "User Expansion"],
            answer: 2
        },
        {
            q: "Which of the following is a CSS framework?",
            options: ["React", "Laravel", "Tailwind", "Django"],
            answer: 2
        },
        {
            q: "What does HTML provide for a webpage?",
            options: ["Styling and colors", "Database connection", "Structure and content", "Interactive animations"],
            answer: 2
        }
    ];

    let currentQIndex = 0;
    let score = 0;
    let timerInterval;
    let secondsElapsed = 0;

    function showScreen(id) {
        document.querySelectorAll('.quiz-container').forEach(el => el.classList.remove('active'));
        document.getElementById(id).classList.add('active');
    }

    function startQuiz() {
        currentQIndex = 0;
        score = 0;
        secondsElapsed = 0;
        loadQuestion();
        showScreen('quiz-question');
        
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            secondsElapsed++;
            const mins = String(Math.floor(secondsElapsed / 60)).padStart(2, '0');
            const secs = String(secondsElapsed % 60).padStart(2, '0');
            document.getElementById('q-timer').innerHTML = `<i class="fas fa-clock"></i> ${mins}:${secs}`;
        }, 1000);
    }

    function loadQuestion() {
        const q = questions[currentQIndex];
        document.getElementById('q-current').innerText = currentQIndex + 1;
        document.getElementById('q-total').innerText = questions.length;
        document.getElementById('q-progress').style.width = `${((currentQIndex + 1) / questions.length) * 100}%`;
        document.getElementById('question-text').innerText = q.q;
        
        const optsContainer = document.getElementById('options-container');
        optsContainer.innerHTML = '';
        
        q.options.forEach((opt, index) => {
            const btn = document.createElement('button');
            btn.className = 'option-btn';
            btn.innerText = opt;
            btn.onclick = () => selectOption(index, btn);
            optsContainer.appendChild(btn);
        });

        document.getElementById('next-btn-container').style.display = 'none';
    }

    let hasAnswered = false;

    function selectOption(selectedIndex, btnElement) {
        if(hasAnswered) return;
        hasAnswered = true;

        const correctIndex = questions[currentQIndex].answer;
        const allBtns = document.querySelectorAll('.option-btn');
        
        if(selectedIndex === correctIndex) {
            btnElement.classList.add('correct');
            score++;
        } else {
            btnElement.classList.add('wrong');
            allBtns[correctIndex].classList.add('correct');
        }

        document.getElementById('next-btn-container').style.display = 'block';
    }

    function nextQuestion() {
        hasAnswered = false;
        currentQIndex++;
        if(currentQIndex < questions.length) {
            loadQuestion();
        } else {
            endQuiz();
        }
    }

    function endQuiz() {
        clearInterval(timerInterval);
        showScreen('quiz-result');
        const finalPercentage = Math.round((score / questions.length) * 100);
        document.getElementById('score-text').innerText = finalPercentage + '%';
        document.getElementById('correct-text').innerText = score;
        
        // Save for offline recall
        localStorage.setItem('edu_quiz_score', finalPercentage);
    }

    function resetQuiz() {
        showScreen('quiz-welcome');
        const savedScore = localStorage.getItem('edu_quiz_score');
        if(savedScore) {
            document.getElementById('last-score').style.display = 'block';
            document.getElementById('last-score').innerText = `Last attempt score: ${savedScore}%`;
        }
    }
</script>
@endsection
