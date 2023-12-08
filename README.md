# Snippet Error Noti

Notify Laravel errors to Slack with a clean UI and include a code snippet.

## Installation

```bash
composer require pyaesoneaung/snippet-error-noti
```

.env

```
SNIPPET_ERROR_NOTI_ENABLE=true
SNIPPET_ERROR_NOTI_WEBHOOK=https://hooks.slack.com/services/.../...
```

Enable the capture of exceptions for reporting to Slack by implementing the following change in your `app/Exceptions/Handler.php` file.

```php
use PyaeSoneAung\SnippetErrorNoti\SnippetErrorNoti;

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