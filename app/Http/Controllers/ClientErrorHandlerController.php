<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientErrorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $context['ip'] = request()->ips();
        $context['path'] = request()->path;

        if (auth()->check()) {
            $context['user_ulid'] = auth()->user()->ulid;
        }

        Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/client/javascript.log'),
        ])->error(
            message: $request->get('message'),
            context: $context
        );
    }
}
