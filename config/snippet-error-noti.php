<?php

return [
    'enable' => env('SNIPPET_ERROR_NOTI_ENABLE', false),

    'webhook' => env('SNIPPET_ERROR_NOTI_WEBHOOK'),

    'trace_handler' => PyaeSoneAung\SnippetErrorNoti\Handlers\BacktraceHandler::class,

    'notification_handler' => PyaeSoneAung\SnippetErrorNoti\Handlers\SlackNotificationHandler::class,
];
