<?php

namespace PyaeSoneAung\SnippetErrorNoti\Handlers;

use PyaeSoneAung\SnippetErrorNoti\Contracts\NotificationHandler;
use PyaeSoneAung\SnippetErrorNoti\Contracts\TraceHandler;
use Spatie\SlackAlerts\Facades\SlackAlert;

class SlackNotificationHandler implements NotificationHandler
{
    public function notify(TraceHandler $traceHandler): void
    {
        if (filter_var(config('snippet-error-noti.webhook'), FILTER_VALIDATE_URL)) {
            $blocks = [
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "> {$traceHandler->getMessage()}",
                    ],
                ],
            ];

            if ($traceHandler->getRouteAction()) {
                $blocks[] = [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "*RouteAction:*\n{$traceHandler->getRouteAction()}",
                    ],
                ];
            }

            $blocks[] = [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "*Request ({$traceHandler->getRequestMethod()}):*\n{$traceHandler->getRequestUrl()}",
                ],
            ];

            $blocks[] = [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "*File:*\n{$traceHandler->getFile()} :{$traceHandler->getLineNumber()}",
                ],
            ];

            if ($traceHandler->getSnippet()) {
                $blocks[] = [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "```{$traceHandler->getSnippet()}```",
                    ],
                ];
            }

            SlackAlert::to(config('snippet-error-noti.webhook'))
                ->blocks($blocks);
        }
    }
}
