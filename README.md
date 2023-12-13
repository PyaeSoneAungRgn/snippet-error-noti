![Snippet Error Noti](https://repository-images.githubusercontent.com/729276965/f357d0c9-69ee-4632-88ae-e77cac7fbd79)

[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/PyaeSoneAungRgn/snippet-error-noti/run-tests.yml?branch=main&label=test)](https://github.com/PyaeSoneAungRgn/snippet-error-noti/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/pyaesoneaung/snippet-error-noti)](https://packagist.org/packages/pyaesoneaung/snippet-error-noti)

# Snippet Error Noti

Notify Laravel errors to Slack with a clean UI and include a code snippet.

## Installation

```bash
composer require pyaesoneaung/snippet-error-noti
```

.env

```
SNIPPET_ERROR_NOTI_ENABLE=true
SNIPPET_ERROR_NOTI_WEBHOOK=slack-webhook-url
```
You can learn how to obtain a webhook URL in the [Slack API documentation](https://api.slack.com/messaging/webhooks). Under the hood, [spatie/laravel-slack-alerts](https://github.com/spatie/laravel-slack-alerts) is utilized to communicate with Slack.

## Usage

Enable the capture of exceptions for reporting to Slack by implementing the following change in your `app/Exceptions/Handler.php` file.

```php
use SnippetErrorNoti;
use Throwable;

public function register(): void
{
    $this->reportable(function (Throwable $e) {
        SnippetErrorNoti::captureException($e);
    });
}
```

## Testing

```bash
composer test
```
