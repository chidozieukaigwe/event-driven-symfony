<?php

declare(strict_types=1);

namespace App\Error;

use Throwable;

class ErrorHandler implements ErrorHandlerInterface
{
    public function handle(Throwable $exception): void
    {
        // Implement your error handling logic here
        // For example, Log/Alert to a centralized system (Clockwatch / Datadog / etc.)
        error_log($exception->getMessage());
    }
}
