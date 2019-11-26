<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $originString = config('cors.allowed_origins');

        if (strpos($originString, ',') !== false) {
            $allowedOrigins = explode(',', $originString);
        } else {
            $allowedOrigins = [$originString];
        }

        if (in_array($request->header('origin'), $allowedOrigins)) {
            $origin = $request->header('origin');
        } else {
            $origin = '';
        }

        $headers = [
            'Access-Control-Allow-Origin' => $origin,
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, X-Token-Auth, Authorization, x-csrf-token',
        ];

        return $next($request)->withHeaders($headers);
    }
}
