<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogUserLocation
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cek kalau user sudah login
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'subject_type' => get_class(Auth::user()),
                'activity' => 'Login',
                'description' => 'User logged in',
                'url' => $request->fullUrl(),
                'date' => now()->toDateString(),
                'time' => now()->toTimeString(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $response;
    }
}
