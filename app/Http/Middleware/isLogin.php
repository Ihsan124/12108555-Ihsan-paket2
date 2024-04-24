<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // mengcek di auth ada data user yg login atau tidak
        // Jika ada maka akan masuk ke dalam if
        // Jika tidak maka akan masuk kedalam else
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect()->route('login.index');
        }
    }
}