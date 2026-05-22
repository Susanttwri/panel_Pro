<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            if ($user?->isStudent()) {
                return redirect()->route('student.dashboard')
                    ->with('cart_error', 'Admin access only. You are logged in as a student.');
            }

            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
