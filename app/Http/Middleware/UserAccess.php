<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //cek sudah login atau belum
        if(!auth()->check() && auth()->user()->id == Session()->get('id_user')){
            return redirect()->route('error-403');
        }
        
        return $next($request);
        
    }
}
