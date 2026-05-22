<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@edu.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );
        $admin->update(['role' => 'admin']);

        // Instructors
        $instructors = [
            ['name' => 'Dr. Sarah Johnson', 'email' => 'sarah@edu.com', 'specialization' => 'Mathematics', 'qualification' => 'PhD Mathematics', 'experience_years' => 12, 'bio' => 'Expert mathematician with 12 years of teaching experience at top universities.'],
            ['name' => 'Prof. Michael Chen', 'email' => 'michael@edu.com', 'specialization' => 'Computer Science', 'qualification' => 'PhD Computer Science', 'experience_years' => 8, 'bio' => 'Full-stack developer turned educator, passionate about making tech accessible.'],
            ['name' => 'Ms. Emily Rodriguez', 'email' => 'emily@edu.com', 'specialization' => 'English Literature', 'qualification' => 'MA English Literature', 'experience_years' => 6, 'bio' => 'Storyteller and literary critic with a flair for creative writing instruction.'],
            ['name' => 'Dr. James Williams', 'email' => 'james@edu.com', 'specialization' => 'Physics', 'qualification' => 'PhD Physics', 'experience_years' => 15, 'bio' => 'Research physicist and award-winning educator at Cambridge.'],
        ];

        $createdInstructors = [];
        foreach ($instructors as $data) {
            $createdInstructors[] = Instructor::firstOrCreate(['email' => $data['email']], array_merge($data, ['is_active' => true, 'phone' => '+1-555-' . rand(1000, 9999)]));
        }

        // Courses
        $courses = [
            ['title' => 'Advanced Mathematics', 'category' => 'Mathematics', 'level' => 'Advanced', 'price' => 299, 'duration_hours' => 48, 'instructor' => 0, 'is_featured' => true],
            ['title' => 'Web Development Bootcamp', 'category' => 'Technology', 'level' => 'Beginner', 'price' => 399, 'duration_hours' => 60, 'instructor' => 1, 'is_featured' => true],
            ['title' => 'Creative Writing Masterclass', 'category' => 'Literature', 'level' => 'Intermediate', 'price' => 199, 'duration_hours' => 30, 'instructor' => 2, 'is_featured' => true],
            ['title' => 'Quantum Physics Fundamentals', 'category' => 'Science', 'level' => 'Advanced', 'price' => 349, 'duration_hours' => 40, 'instructor' => 3, 'is_featured' => true],
            ['title' => 'Python Programming for Beginners', 'category' => 'Technology', 'level' => 'Beginner', 'price' => 149, 'duration_hours' => 25, 'instructor' => 1, 'is_featured' => false],
            ['title' => 'Calculus & Linear Algebra', 'category' => 'Mathematics', 'level' => 'Intermediate', 'price' => 249, 'duration_hours' => 36, 'instructor' => 0, 'is_featured' => false],
            ['title' => 'English Grammar Essentials', 'category' => 'Literature', 'level' => 'Beginner', 'price' => 99, 'duration_hours' => 20, 'instructor' => 2, 'is_featured' => false],
            ['title' => 'Data Science with Python', 'category' => 'Technology', 'level' => 'Intermediate', 'price' => 449, 'duration_hours' => 55, 'instructor' => 1, 'is_featured' => false],
        ];

        $createdCourses = [];
        foreach ($courses as $course) {
            $instructor = $createdInstructors[$course['instructor']];
            $createdCourses[] = Course::firstOrCreate(
                [
                    'title'         => $course['title'],
                    'instructor_id' => $instructor->id,
                ],
                [
                    'slug'           => Str::slug($course['title']) . '-' . strtolower(Str::random(4)),
                    'title'          => $course['title'],
                    'description'    => 'A comprehensive course covering all aspects of ' . $course['title'] . '. Designed for ' . $course['level'] . ' learners, this course will take you from fundamentals to mastery through hands-on projects and expert guidance.',
                    'category'       => $course['category'],
                    'level'          => $course['level'],
                    'price'          => $course['price'],
                    'duration_hours' => $course['duration_hours'],
                    'start_date'     => now()->setYear(2026)->addMonths(rand(1, 5))->addDays(rand(1, 20)),
                    'deadline'       => now()->setYear(2026)->addMonths(rand(0, 1))->addDays(rand(1, 20)),
                    'max_students'   => 100,
                    'is_active'      => true,
                    'is_featured'    => $course['is_featured'],
                    'instructor_id'  => $instructor->id,
                ]
            );
        }

        // Students
        $studentData = [
            ['name' => 'Alice Thompson', 'email' => 'alice@student.com', 'gender' => 'female'],
            ['name' => 'Bob Martinez', 'email' => 'bob@student.com', 'gender' => 'male'],
            ['name' => 'Carol White', 'email' => 'carol@student.com', 'gender' => 'female'],
            ['name' => 'David Lee', 'email' => 'david@student.com', 'gender' => 'male'],
            ['name' => 'Emma Davis', 'email' => 'emma@student.com', 'gender' => 'female'],
            ['name' => 'Frank Wilson', 'email' => 'frank@student.com', 'gender' => 'male'],
            ['name' => 'Grace Taylor', 'email' => 'grace@student.com', 'gender' => 'female'],
            ['name' => 'Henry Brown', 'email' => 'henry@student.com', 'gender' => 'male'],
            ['name' => 'Iris Garcia', 'email' => 'iris@student.com', 'gender' => 'female'],
            ['name' => 'Jack Anderson', 'email' => 'jack@student.com', 'gender' => 'male'],
        ];

        $createdStudents = [];
        foreach ($studentData as $sd) {
            $createdStudents[] = Student::firstOrCreate(
                ['email' => $sd['email']],
                [
                    'name'       => $sd['name'],
                    'phone'      => '+1-555-' . rand(1000, 9999),
                    'gender'     => $sd['gender'],
                    'status'     => 'active',
                    'student_id' => 'STU-' . strtoupper(Str::random(8)),
                    'address'    => rand(100, 999) . ' Main Street, City, State',
                ]
            );
        }

        // Enrollments
        $statuses = ['active', 'active', 'active', 'completed', 'dropped'];
        foreach ($createdStudents as $student) {
            $numCourses = rand(1, 3);
            $shuffled = $createdCourses;
            shuffle($shuffled);
            $selected = array_slice($shuffled, 0, $numCourses);

            foreach ($selected as $course) {
                $exists = Enrollment::where('student_id', $student->id)
                    ->where('course_id', $course->id)
                    ->exists();
                if (!$exists) {
                    $status = $statuses[array_rand($statuses)];
                    Enrollment::create([
                        'student_id'  => $student->id,
                        'course_id'   => $course->id,
                        'enrolled_at' => now()->subDays(rand(10, 180)),
                        'status'      => $status,
                        'progress'    => $status === 'completed' ? 100 : ($status === 'dropped' ? rand(0, 30) : rand(10, 90)),
                        'amount_paid' => $course->price,
                        'notes'       => null,
                    ]);
                }
            }
        }

        $this->call(QuizSeeder::class);
    }
}
