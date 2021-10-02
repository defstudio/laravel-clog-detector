<?php

/** @noinspection PhpMissingParamTypeInspection */

declare(strict_types=1);

namespace DefStudio\ClogDetector\Middleware;

use Closure;
use DefStudio\ClogDetector\Exceptions\LongRunningException;
use URL;

class MeasureHttpResponseTime
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next): mixed
    {
        $start = app('request')->server('REQUEST_TIME_FLOAT');
        $response = $next($request);
        $executionTime = microtime(true) - $start;

        $maxAllowedSeconds = config('clog-detector.max_http_seconds', 0);
        if ($maxAllowedSeconds === 0) {
            return $response;
        }

        if ($request->routeIs(...config('clog-detector.ignored_routes', []))) {
            return $response;
        }

        //@phpstan-ignore-next-line
        if (in_array(URL::current(), config('clog-detector.ignored_urls', []), true)) {
            return $response;
        }

        if ($executionTime > $maxAllowedSeconds) {
            report(LongRunningException::httpRequestTookLongerThanAllowed($executionTime ?? 0, $maxAllowedSeconds));
        }

        return $response;
    }
}
