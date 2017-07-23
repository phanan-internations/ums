<?php

namespace App\Http\Middleware;

use App\Models\Administrator;
use Closure;

class VerifyTokenMiddleware
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
        if (! $header = $request->header('Authorization')) {
            abort(403, 'Forbidden');
        }

        if (! preg_match('/Bearer (.*)/', $header, $matches)) {
            abort(403, 'Forbidden');
        }

        $token = $matches[1];
        if (! ($token && $admin = Administrator::where('api_token', $token)->first())) {
            abort(403, 'Forbidden');
        }

        // Store the administrator into the request object for later access
        $request->administrator = $admin;

        return $next($request);
    }
}
