<?php

namespace PyaeSoneAung\SnippetErrorNoti\Contracts;

use Throwable;

interface TraceHandler
{
    public function parse(Throwable $throwable): TraceHandler;

    public function getMessage(): string;

    public function getFile(): string;

    public function getLineNumber(): int;

    public function getSnippet(): ?string;

    public function getRouteAction(): ?string;

    public function getRequestUrl(): string;

    public function getRequestMethod(): string;

    public function getCliArgv(): array;
}
