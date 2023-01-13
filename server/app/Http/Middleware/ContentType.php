<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Content-Type');

        // GET request axios auto remove Content-Type: application/json, so we don't check header Content-Type of GET request
        if ($request->isMethod('GET') || strtolower(trim($header)) == 'application/json') {
            return $next($request);
        }

        return response([
            'error' => 'Content-type must be application/json',
            'status code' => '400'
        ], 400);
    }
}
