<?php

use Illuminate\Support\Facades\Bus;
use PyaeSoneAung\SnippetErrorNoti\Facades\SnippetErrorNoti;
use Spatie\SlackAlerts\Jobs\SendToSlackChannelJob;

beforeEach(function () {
    Bus::fake();
});

it('can notify to slack', function () {
    try {
        1 / 0;
    } catch (\Throwable $e) {
        SnippetErrorNoti::captureException($e);
    }
    Bus::assertDispatched(SendToSlackChannelJob::class);
});
