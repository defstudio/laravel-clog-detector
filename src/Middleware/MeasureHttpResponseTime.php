<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\ClogDetector\Middleware;

use Closure;
use DefStudio\ClogDetector\Exceptions\LongRunningException;

class MeasureHttpResponseTime
{
    public function handle($request, Closure $next): mixed
    {


        $start = app('request')->server('REQUEST_TIME_FLOAT');
        $response = $next($request);
        $execution_time = microtime(true) - $start;

        if (empty($max_allowed_seconds = config('clog-detector.max_http_seconds'))) {
            return $response;
        }

        if ($request->routeIs(...config('clog-detector.ignored_routes', []))) {
            return $response;
        }

        if ($execution_time > $max_allowed_seconds) {
            report(LongRunningException::tookLongerThanAllowed($execution_time, $max_allowed_seconds));
        }

        return $response;
    }
}
