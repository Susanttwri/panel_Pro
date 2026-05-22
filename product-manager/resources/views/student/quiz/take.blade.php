@extends('layouts.student')
@section('title', 'Quiz — ' . $enrollment->course->title)

@section('styles')
<style>
    .quiz-q { background:var(--card); border:1px solid var(--border); border-radius:12px; padding:22px; margin-bottom:16px; }
    .quiz-opt { display:block; width:100%; text-align:left; padding:12px 14px; margin-top:8px; border:1px solid var(--border); border-radius:8px; background:#fff; cursor:pointer; font-family:inherit; font-size:14px; }
    .quiz-opt:hover { border-color:#111; }
</style>
@endsection

@section('content')
    <a href="{{ route('student.enrollment.show', $enrollment) }}" style="font-size:13px; color:var(--muted); text-decoration:none;">← Back to course</a>
    <h1 class="page-title" style="margin-top:12px;">Quiz: {{ $enrollment->course->title }}</h1>
    <p class="page-sub">{{ $questions->count() }} questions · Results update your progress bar</p>

    <form action="{{ route('student.quiz.submit', $enrollment) }}" method="POST">
        @csrf
        @foreach($questions as $i => $q)
            <div class="quiz-q">
                <div style="font-size:12px; font-weight:600; color:var(--muted); margin-bottom:8px;">Question {{ $i + 1 }}</div>
                <div style="font-weight:700; font-size:16px; margin-bottom:8px;">{{ $q->question }}</div>
                @foreach($q->options as $oi => $opt)
                    <label style="display:block;">
                        <input type="radio" name="answers[{{ $q->id }}]" value="{{ $oi }}" required style="margin-right:8px;">
                        {{ $opt }}
                    </label>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary" style="font-size:16px; padding:14px 28px;">
            <i class="fas fa-paper-plane"></i> Submit Quiz
        </button>
    </form>
@endsection
