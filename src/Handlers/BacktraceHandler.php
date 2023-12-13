<?php

namespace PyaeSoneAung\SnippetErrorNoti\Handlers;

use Illuminate\Support\Facades\Route;
use PyaeSoneAung\SnippetErrorNoti\Contracts\TraceHandler;
use Spatie\Backtrace\Backtrace;
use Throwable;

class BacktraceHandler implements TraceHandler
{
    private $applicationFrame;

    private $throwable;

    public function parse(Throwable $throwable): TraceHandler
    {
        $backtrace = Backtrace::createForThrowable($throwable)
            ->applicationPath(base_path());
        $frames = $backtrace->frames();

        $this->applicationFrame = $frames[$backtrace->firstApplicationFrameIndex()] ?? null;
        $this->throwable = $throwable;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->throwable?->getMessage();
    }

    public function getFile(): string
    {
        if ($this->applicationFrame) {
            return $this->applicationFrame->file;
        }

        return $this->throwable->getFile();
    }

    public function getLineNumber(): int
    {
        if ($this->applicationFrame) {
            return $this->applicationFrame->lineNumber;
        }

        return $this->throwable->getLine();
    }

    public function getSnippet(): ?string
    {
        if ($this->applicationFrame) {
            $snippet = $this->applicationFrame->getSnippet(10);

            return collect($snippet)->map(function ($line, $number) {
                $formattedLine = $number.' '.$line;
                if ($number == $this->applicationFrame->lineNumber) {
                    $formattedLine .= ' 👈';
                }

                return $formattedLine;
            })
                ->join(PHP_EOL);
        }

        return null;
    }

    public function getRouteAction(): ?string
    {
        return Route::currentRouteAction();
    }

    public function getRequestUrl(): string
    {
        return request()->fullUrl();
    }

    public function getRequestMethod(): string
    {
        return request()->method();
    }

    public function getCliArgv(): array
    {
        return $_SERVER['argv'] ?? [];
    }
}
