<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApplicationJson
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
        $header = $request->header('Accept');
        if (strtolower(trim($header)) == 'application/json') {
            return $next($request);
        }
        return response([
            'error' => 'Accept type must be application/json'
        ]);
    }
}
