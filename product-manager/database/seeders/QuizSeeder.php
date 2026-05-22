<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            'Technology' => [
                ['What does HTML stand for?', ['Hyper Text Markup Language', 'High Tech Modern Language', 'Home Tool Markup Language', 'Hyperlinks Text Mark Language'], 0],
                ['Which language runs in the browser?', ['Python', 'JavaScript', 'Java', 'C++'], 1],
                ['What is a REST API?', ['A database', 'An architectural style for APIs', 'A CSS framework', 'A hosting service'], 1],
                ['Git is used for?', ['Image editing', 'Version control', 'Email', 'Spreadsheets'], 1],
                ['What does SQL stand for?', ['Structured Query Language', 'Simple Question List', 'System Quality Level', 'Secure Queue Link'], 0],
            ],
            'Mathematics' => [
                ['Derivative of x² is?', ['x', '2x', 'x²', '2'], 1],
                ['Value of π (approx)?', ['3.14', '2.71', '1.62', '4.20'], 0],
                ['Sum of angles in a triangle?', ['90°', '180°', '270°', '360°'], 1],
                ['√144 equals?', ['10', '11', '12', '14'], 2],
                ['2³ equals?', ['6', '8', '9', '16'], 1],
            ],
            'Science' => [
                ['Speed of light unit?', ['m/s', 'km/h', 'mph', 'knots'], 0],
                ['Chemical symbol for water?', ['H2O', 'CO2', 'O2', 'NaCl'], 0],
                ['Planet closest to the Sun?', ['Venus', 'Mercury', 'Mars', 'Earth'], 1],
                ['Force = mass × ?', ['velocity', 'acceleration', 'energy', 'power'], 1],
                ['DNA stands for?', ['Deoxyribonucleic Acid', 'Dynamic Nuclear Acid', 'Dual Nitrogen Array', 'Dense Node Atom'], 0],
            ],
            'Literature' => [
                ['Who wrote Romeo and Juliet?', ['Dickens', 'Shakespeare', 'Austen', 'Hemingway'], 1],
                ['A sonnet has how many lines?', ['10', '12', '14', '16'], 2],
                ['Main character in a story is the?', ['Antagonist', 'Protagonist', 'Narrator', 'Editor'], 1],
                ['Metaphor compares without using?', ['like or as', 'numbers', 'colors', 'names'], 0],
                ['Plot is the sequence of?', ['words', 'events', 'letters', 'chapters'], 1],
            ],
            'default' => [
                ['PanelPro courses help you?', ['Learn new skills', 'Cook food', 'Drive cars', 'Fix hardware'], 0],
                ['Quizzes measure your?', ['Height', 'Understanding', 'Age', 'Location'], 1],
                ['Study regularly improves?', ['Memory & skills', 'Only luck', 'Nothing', 'Sleep only'], 0],
                ['Course progress is shown as?', ['Percentage', 'Weight', 'Color only', 'Sound'], 0],
                ['Completing a quiz updates?', ['Your course progress', 'Weather', 'Stock prices', 'Map routes'], 0],
            ],
        ];

        foreach (Course::all() as $course) {
            if ($course->quizQuestions()->exists()) {
                continue;
            }

            $set = $templates[$course->category] ?? $templates['default'];

            foreach ($set as $i => [$question, $options, $correct]) {
                QuizQuestion::create([
                    'course_id'      => $course->id,
                    'question'       => $question,
                    'options'        => $options,
                    'correct_index'  => $correct,
                    'sort_order'     => $i + 1,
                ]);
            }
        }
    }
}
