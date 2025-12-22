<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Chỉ kiểm tra xem user đã đăng nhập chưa
        // Tất cả user đều có quyền admin
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        return $next($request);
    }
}
