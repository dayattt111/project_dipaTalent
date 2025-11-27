<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang bisa mengakses bagian ini.');
        }

        return $next($request);
    }
}
