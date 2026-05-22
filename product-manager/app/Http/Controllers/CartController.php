<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function __construct(private CartService $cart)
    {
        $this->middleware(['auth', 'student']);
    }

    public function index()
    {
        $items = $this->cart->items();

        return view('student.cart.index', [
            'items' => $items,
            'total' => $this->cart->total(),
        ]);
    }

    public function add(Request $request, Course $course)
    {
        $error = $this->cart->add($course);

        if ($error) {
            return back()->with('cart_error', $error);
        }

        return redirect()
            ->route('student.cart.index')
            ->with('cart_success', '"' . $course->title . '" added to your cart.');
    }

    public function remove(Course $course)
    {
        $this->cart->remove($course->id);

        return redirect()->route('student.cart.index')->with('cart_success', 'Course removed from cart.');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->route('student.cart.index')->with('cart_success', 'Your cart has been cleared.');
    }

    public function checkout()
    {
        $items = $this->cart->items();

        if ($items->isEmpty()) {
            return redirect()->route('student.cart.index')->with('cart_error', 'Your cart is empty.');
        }

        return view('student.cart.checkout', [
            'items' => $items,
            'total' => $this->cart->total(),
        ]);
    }

    public function processCheckout(Request $request)
    {
        $items = $this->cart->items();

        if ($items->isEmpty()) {
            return redirect()->route('student.cart.index')->with('cart_error', 'Your cart is empty.');
        }

        $user = Auth::user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $student = $user->studentProfile;

        if (!$student) {
            $student = Student::create([
                'user_id'    => $user->id,
                'email'      => $user->email,
                'name'       => $validated['name'],
                'phone'      => $validated['phone'] ?? null,
                'status'     => 'active',
                'student_id' => 'STU-' . strtoupper(Str::random(8)),
            ]);
        } else {
            $student->update([
                'name'  => $validated['name'],
                'phone' => $validated['phone'] ?? $student->phone,
            ]);
        }

        $enrolled = 0;
        $skipped = [];

        foreach ($items as $course) {
            if (!$this->cart->canPurchase($course)) {
                $skipped[] = $course->title;
                continue;
            }

            $exists = Enrollment::where('student_id', $student->id)
                ->where('course_id', $course->id)
                ->exists();

            if ($exists) {
                $skipped[] = $course->title . ' (already enrolled)';
                continue;
            }

            Enrollment::create([
                'student_id'  => $student->id,
                'course_id'   => $course->id,
                'enrolled_at' => now(),
                'status'      => 'active',
                'progress'    => 0,
                'amount_paid' => $course->price,
            ]);

            $enrolled++;
        }

        $this->cart->clear();

        $message = $enrolled > 0
            ? "Success! You are enrolled in {$enrolled} course(s). Welcome aboard!"
            : 'No courses could be enrolled. Please try again.';

        if (!empty($skipped)) {
            $message .= ' Skipped: ' . implode(', ', $skipped);
        }

        return redirect()->route('student.enrollments')->with('cart_success', $message);
    }
}
