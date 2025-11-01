<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MsHrUser;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();

        // Check if user is instance of MsHrUser and has Admin role
        if (!($user instanceof MsHrUser) || $user->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini. Hanya Admin yang diizinkan.');
        }

        // Check if user is active - using strict comparison
        if ($user->is_active != 1) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda belum aktif. Silakan hubungi administrator.');
        }

        return $next($request);
    }
}
