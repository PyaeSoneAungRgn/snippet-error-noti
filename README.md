![Snippet Error Noti](https://repository-images.githubusercontent.com/729276965/f357d0c9-69ee-4632-88ae-e77cac7fbd79)

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
You can learn how to obtain a webhook URL in the [Slack API documentation](https://api.slack.com/messaging/webhooks).

Enable the capture of exceptions for reporting to Slack by implementing the following change in your `app/Exceptions/Handler.php` file.

```php
use SnippetErrorNoti;

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
