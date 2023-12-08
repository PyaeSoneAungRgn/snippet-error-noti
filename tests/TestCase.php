<?php

namespace PyaeSoneAung\SnippetErrorNoti\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use PyaeSoneAung\SnippetErrorNoti\SnippetErrorNotiServiceProvider;
use Spatie\SlackAlerts\SlackAlertsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            SnippetErrorNotiServiceProvider::class,
            SlackAlertsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('snippet-error-noti.enable', true);
        config()->set('snippet-error-noti.webhook', 'https://www.example.com');
    }
}
