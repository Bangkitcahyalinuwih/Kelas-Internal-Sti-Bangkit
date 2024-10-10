<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        //Jika tidak ada pengguna yang login, redirect atau return error
        // if (!$userId) {
        //     return redirect('/')->with('error', 'Anda harus login dulu!');
        // }

        // Set ID pengguna ke dalam request, sehingga bisa diakses di controller
        $request->merge(['id' => $userId]);

        return $next($request);
    }
}
