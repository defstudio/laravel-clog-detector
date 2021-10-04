<?php

/* @noinspection PhpUnhandledExceptionInspection */
/* @noinspection PhpUnused */

declare(strict_types=1);

namespace DefStudio\ClogDetector;

use DefStudio\ClogDetector\Exceptions\WrongConfigurationException;
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

        $this->bootMeasureResponseTime();
    }

    protected function registerMiddleware(string $middleware): void
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware($middleware);
    }

    protected function bootMeasureResponseTime(): void
    {
        $contract = Contracts\MeasureHttpResponseTime::class;

        $this->app->singleton(Contracts\MeasureHttpResponseTime::class, function ($app) use ($contract) {
            $config_key = 'clog-detector.slow_responses.middleware';
            $middleware = config($config_key);

            if ($middleware == null || !is_subclass_of($middleware, $contract)) {
                throw WrongConfigurationException::wrong_contract_used($config_key, $contract);
            }

            return $app->make($middleware);
        });

        $this->registerMiddleware($contract);

        if (config('clog-detector.slow_responses.report') == true) {
            $this->app->make($contract)->enabled(true);
        }
    }
}
