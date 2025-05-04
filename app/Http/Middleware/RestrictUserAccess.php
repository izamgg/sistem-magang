<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestrictUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (strtolower($user->role) === 'user' || strtolower($user->role) === 'dosen' || strtolower($user->role) === 'dosen_penguji') {
                if ($request->is('data-akun-dosen') || $request->is('data-akun-dosen/create') || $request->is('data-akun-dosen/update-role/*')) {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
