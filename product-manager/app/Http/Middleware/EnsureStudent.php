<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isStudent()) {
            if ($user?->isAdmin()) {
                return redirect()->route('admin.dashboard')
                    ->with('cart_error', 'Please use the admin panel. Student area is for learners only.');
            }

            $request->session()->put('url.intended', $request->fullUrl());

            return redirect()
                ->route('student.login')
                ->with('cart_error', 'Please log in as a student to continue.');
        }

        return $next($request);
    }
}
