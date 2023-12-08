<?php

namespace PyaeSoneAung\SnippetErrorNoti\Contracts;

interface NotificationHandler
{
    public function notify(TraceHandler $traceHandler): void;
}
