<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\ClogDetector;

use DefStudio\ClogDetector\Middleware\MeasureHttpResponseTime;
use Illuminate\Contracts\Http\Kernel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__."/../config/clog-detector.php", 'clog-detector');

        $this->publishes([
            __DIR__."/../config/clog-detector.php" => config_path('clog-detector.php'),
        ], 'config');

        $this->registerMiddleware(MeasureHttpResponseTime::class);
    }

    protected function registerMiddleware(string $middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}
