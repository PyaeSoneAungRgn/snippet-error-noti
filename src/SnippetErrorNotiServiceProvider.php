<?php

namespace PyaeSoneAung\SnippetErrorNoti;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SnippetErrorNotiServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->app->singleton(
            abstract: SnippetErrorNoti::class,
            concrete: fn () => new SnippetErrorNoti(
                traceHandler: app(config('snippet-error-noti.trace_handler')),
                notificationHandler: app(config('snippet-error-noti.notification_handler')),
            ),
        );
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('snippet-error-noti')
            ->hasConfigFile();
    }
}
