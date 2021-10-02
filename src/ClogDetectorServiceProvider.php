<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace DefStudio\ClogDetector;

use DefStudio\ClogDetector\Middleware\MeasureHttpResponseTime;
use Illuminate\Contracts\Http\Kernel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ClogDetectorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-clog-detector')
            ->hasConfigFile();

        $this->registerMiddleware(MeasureHttpResponseTime::class);
    }

    protected function registerMiddleware(string $middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}
