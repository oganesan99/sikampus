<?php

namespace App\Traits;

use App\Jobs\LogAppActivityJob;
use Illuminate\Support\Str;

trait LogAppActivity
{
    /**
     * Log Batch ID Property.
     *
     * @var string
     */
    private $logBatchId = '';

    /**
     * Set the logBatchId Property.
     */
    public function __construct()
    {
        $this->logBatchId = explode('-', Str::uuid())[1];
    }

    /**
     * Log application activity.
     *
     * @api
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function logApp(string $msg, array $context = []): void
    {
        $context['log_batch_id'] = $this->logBatchId;
        $context['ip'] = request()->ips();

        if (auth()->check()) {
            $context['user_ulid'] = $this->userUlid;
        }

        $context['params'] = request()->all();
        $context['fingerprint'] = request()->fingerprint();
        $context['header'] = request()->header();

        LogAppActivityJob::dispatch(
            message: $msg,
            context: $context,
        );
    }
}
