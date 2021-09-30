<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpMissingParamTypeInspection */

namespace DefStudio\ClogDetector\Middleware;

use Closure;
use DefStudio\ClogDetector\Exceptions\LongRunningException;
use URL;

class MeasureHttpResponseTime
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {


        $start = app('request')->server('REQUEST_TIME_FLOAT');
        $response = $next($request);
        $executionTime = microtime(true) - $start;

        if (empty($maxAllowedSeconds = config('clog-detector.max_http_seconds'))) {
            return $response;
        }

        if ($request->routeIs(...config('clog-detector.ignored_routes', []))) {
            return $response;
        }

        if (in_array(URL::current(), config('clog-detector.ignored_urls', []))) {
            return $response;
        }

        if ($executionTime > $maxAllowedSeconds) {
            report(LongRunningException::httpRequestTookLongerThanAllowed($executionTime, $maxAllowedSeconds));
        }

        return $response;
    }
}
