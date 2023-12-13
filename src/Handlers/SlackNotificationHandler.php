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

            $routeAction = $traceHandler->getRouteAction();
            if ($routeAction) {
                $blocks[] = [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "*RouteAction:*\n{$routeAction}",
                    ],
                ];
            }

            if (php_sapi_name() == 'cli' || php_sapi_name() == 'phpdbg') {
                $cliArgv = $traceHandler->getCliArgv();
                if ($cliArgv) {
                    $cliArgv = implode(' ', $cliArgv);
                    $blocks[] = [
                        'type' => 'section',
                        'text' => [
                            'type' => 'mrkdwn',
                            'text' => "*CLI Argv:*\n{$cliArgv}",
                        ],
                    ];
                }
            } else {
                $blocks[] = [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "*Request ({$traceHandler->getRequestMethod()}):*\n{$traceHandler->getRequestUrl()}",
                    ],
                ];
            }

            $blocks[] = [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "*File:*\n{$traceHandler->getFile()} :{$traceHandler->getLineNumber()}",
                ],
            ];

            $snippet = $traceHandler->getSnippet();
            if ($snippet) {
                $blocks[] = [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "```{$snippet}```",
                    ],
                ];
            }

            SlackAlert::to(config('snippet-error-noti.webhook'))
                ->blocks($blocks);
        }
    }
}
