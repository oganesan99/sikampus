<?php

namespace App\Http\Middleware;

use App\Traits\LogAppActivity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogUserPageVisits
{
    use LogAppActivity;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $this->logApp('Resource accessed by client.', [
            'path' => $request->fullUrl(),
            'status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
