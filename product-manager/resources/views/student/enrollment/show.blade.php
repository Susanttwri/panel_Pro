@extends('layouts.student')
@section('title', $enrollment->course->title . ' — My Learning')

@section('content')
    <a href="{{ route('student.dashboard') }}" style="font-size:13px; color:var(--muted); text-decoration:none;">← Back to Dashboard</a>

    <h1 class="page-title" style="margin-top:12px;">{{ $enrollment->course->title }}</h1>
    <p class="page-sub">
        {{ $enrollment->course->category }} · {{ $enrollment->course->level }} ·
        {{ $enrollment->course->instructor?->name ?? 'Instructor' }} ·
        Enrolled {{ $enrollment->enrolled_at?->format('M d, Y') }}
    </p>

    <div style="display:grid; grid-template-columns:1fr 280px; gap:24px; align-items:start;">
        <div>
            <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:28px; margin-bottom:20px;">
                <h2 style="font-size:16px; font-weight:700; margin-bottom:16px;">Course Progress</h2>
                @include('partials.course-progress', ['enrollment' => $enrollment])

                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-top:24px;">
                    <div style="background:#f9fafb; border-radius:10px; padding:16px; text-align:center;">
                        <div style="font-size:24px; font-weight:800;">{{ $enrollment->progress }}%</div>
                        <div style="font-size:11px; color:var(--muted); margin-top:4px;">Completed</div>
                    </div>
                    <div style="background:#f9fafb; border-radius:10px; padding:16px; text-align:center;">
                        <div style="font-size:24px; font-weight:800;">{{ $enrollment->remainingPercent() }}%</div>
                        <div style="font-size:11px; color:var(--muted); margin-top:4px;">Remaining</div>
                    </div>
                    <div style="background:#f9fafb; border-radius:10px; padding:16px; text-align:center;">
                        <div style="font-size:24px; font-weight:800;">{{ $enrollment->course->duration_hours }}h</div>
                        <div style="font-size:11px; color:var(--muted); margin-top:4px;">Duration</div>
                    </div>
                </div>
            </div>

            @if($enrollment->course->description)
                <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px; margin-bottom:20px;">
                    <h2 style="font-size:16px; font-weight:700; margin-bottom:12px;">About this course</h2>
                    <p style="font-size:14px; color:var(--muted); line-height:1.7;">{{ $enrollment->course->description }}</p>
                </div>
            @endif

            <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px;">
                <h2 style="font-size:16px; font-weight:700; margin-bottom:12px;">Mark study progress</h2>
                <p style="font-size:13px; color:var(--muted); margin-bottom:16px;">Update manually as you complete lessons (also updates when you pass the quiz).</p>
                <form action="{{ route('student.enrollment.progress', $enrollment) }}" method="POST" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
                    @csrf
                    <input type="range" name="progress" min="0" max="100" value="{{ $enrollment->progress }}" oninput="this.nextElementSibling.value = this.value + '%'" style="flex:1; min-width:200px;">
                    <output style="font-weight:700; min-width:48px;">{{ $enrollment->progress }}%</output>
                    <button type="submit" class="btn btn-ghost">Save Progress</button>
                </form>
            </div>
        </div>

        <aside>
            <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px; margin-bottom:16px;">
                <h3 style="font-size:15px; font-weight:700; margin-bottom:12px;"><i class="fas fa-clipboard-question"></i> Course Quiz</h3>
                <p style="font-size:13px; color:var(--muted); margin-bottom:16px; line-height:1.6;">
                    Take the quiz for this course. Your best score counts toward your progress bar.
                </p>
                <a href="{{ route('student.quiz.show', $enrollment) }}" class="btn btn-primary" style="width:100%; justify-content:center;">
                    <i class="fas fa-play"></i> Take Quiz
                </a>
                @if($enrollment->latestQuizAttempt)
                    <p style="font-size:12px; color:var(--muted); margin-top:14px;">
                        Last attempt: {{ $enrollment->latestQuizAttempt->score }}%
                        ({{ $enrollment->latestQuizAttempt->correct_count }}/{{ $enrollment->latestQuizAttempt->total_questions }})
                        · {{ $enrollment->latestQuizAttempt->created_at->diffForHumans() }}
                    </p>
                @endif
            </div>
            <div style="background:#ecfdf5; border:1px solid #a7f3d0; border-radius:14px; padding:16px; font-size:13px; color:#065f46;">
                <strong>Tip:</strong> Finish the quiz with 80%+ to mark most of the course complete automatically.
            </div>
        </aside>
    </div>
@endsection
