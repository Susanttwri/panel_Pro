<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isStudent()) {
            return redirect()->route('student.dashboard');
        }

        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        if (!Auth::user()->isStudent()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'This account is for administrators. Use the admin login instead.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('student.dashboard'));
    }

    public function showRegister()
    {
        if (Auth::check() && Auth::user()->isStudent()) {
            return redirect()->route('student.dashboard');
        }

        return view('student.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'student',
        ]);

        $student = Student::firstOrNew(['email' => $user->email]);
        $student->fill([
            'user_id' => $user->id,
            'name'    => $user->name,
            'status'  => 'active',
        ]);

        if (!$student->student_id) {
            $student->student_id = 'STU-' . strtoupper(Str::random(8));
        }

        $student->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.dashboard')
            ->with('cart_success', 'Welcome to PanelPro! Browse courses and add them to your cart.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
