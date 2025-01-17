<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(null == $request->user())
        {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        if(!$request->user()->role != 'admin') 
        {
            return response()->json(['message' => 'Unauthorized as admin.'], 401);
        }
        return $next($request);
    }
}
