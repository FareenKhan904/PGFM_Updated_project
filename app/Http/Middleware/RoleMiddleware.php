<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Convert types to integers for comparison (route parameters come as strings)
        $types = array_map('intval', $types);

        // Allow multiple types: admin, doctor, student, etc.
        if (!in_array((int)$user->type, $types, true)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}