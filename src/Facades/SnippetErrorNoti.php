<?php

namespace PyaeSoneAung\SnippetErrorNoti\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void captureException(\Throwable $throwable): void
 *
 * @see \PyaeSoneAung\SnippetErrorNoti\SnippetErrorNoti
 */
class SnippetErrorNoti extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PyaeSoneAung\SnippetErrorNoti\SnippetErrorNoti::class;
    }
}
