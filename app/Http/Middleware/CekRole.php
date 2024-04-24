<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // ...$role akan mengubah yg dipisahkan dengan koma menjadi item array
        // $request->user()->role akan ambil data user yang login bagian role
        if (in_array($request->user()->role, $role)) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}