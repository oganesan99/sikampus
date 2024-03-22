<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $redirect = [];

        if ($request->getQueryString()) {
            $query = '?'.$request->getQueryString();
        } else {
            $query = '';
        }

        if (! $request->is('/')) {
            $redirect['redirect'] = $request->path().$query;
        }

        return $request->expectsJson() ? null : route('login', $redirect);
    }
}
