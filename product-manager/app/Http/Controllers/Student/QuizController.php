<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    protected function findEnrollment(Enrollment $enrollment): Enrollment
    {
        $student = Auth::user()->studentProfile;

        if (!$student || $enrollment->student_id !== $student->id) {
            abort(403);
        }

        return $enrollment->load('course.quizQuestions');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment = $this->findEnrollment($enrollment);
        $questions = $enrollment->course->quizQuestions;

        if ($questions->isEmpty()) {
            return redirect()
                ->route('student.enrollment.show', $enrollment)
                ->with('cart_error', 'No quiz is available for this course yet.');
        }

        return view('student.quiz.take', [
            'enrollment' => $enrollment,
            'questions'  => $questions,
        ]);
    }

    public function submit(Request $request, Enrollment $enrollment)
    {
        $enrollment = $this->findEnrollment($enrollment);
        $questions = $enrollment->course->quizQuestions;

        if ($questions->isEmpty()) {
            return redirect()->route('student.enrollment.show', $enrollment);
        }

        $answers = $request->validate([
            'answers'   => 'required|array',
            'answers.*' => 'required|integer|min:0|max:3',
        ])['answers'];

        $correct = 0;
        foreach ($questions as $question) {
            $given = (int) ($answers[$question->id] ?? -1);
            if ($given === $question->correct_index) {
                $correct++;
            }
        }

        $total = $questions->count();
        $score = (int) round(($correct / $total) * 100);

        QuizAttempt::create([
            'enrollment_id'   => $enrollment->id,
            'score'           => $score,
            'correct_count'   => $correct,
            'total_questions' => $total,
        ]);

        $newProgress = max($enrollment->progress, $score);
        $newQuizBest = max($enrollment->quiz_best_score ?? 0, $score);

        $enrollment->update([
            'progress'         => $newProgress,
            'quiz_best_score'  => $newQuizBest,
            'last_activity_at' => now(),
        ]);

        return redirect()
            ->route('student.enrollment.show', $enrollment)
            ->with('cart_success', "Quiz completed! Score: {$score}% ({$correct}/{$total} correct). Course progress is now {$newProgress}%.");
    }
}
