<?php

namespace PyaeSoneAung\SnippetErrorNoti;

use PyaeSoneAung\SnippetErrorNoti\Contracts\NotificationHandler;
use PyaeSoneAung\SnippetErrorNoti\Contracts\TraceHandler;
use Throwable;

class SnippetErrorNoti
{
    public function __construct(
        private TraceHandler $traceHandler,
        private NotificationHandler $notificationHandler,
    ) {
    }

    public function captureException(Throwable $throwable): void
    {
        if (filter_var(config('snippet-error-noti.enable'), FILTER_VALIDATE_BOOLEAN)) {
            $traceHandler = $this->traceHandler->parse($throwable);
            $this->notificationHandler->notify($traceHandler);
        }
    }
}
