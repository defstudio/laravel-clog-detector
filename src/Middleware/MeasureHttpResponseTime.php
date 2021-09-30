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

        if ($execution_time > 1) {
            report(LongRunningException::tookLongerThanAllowed($execution_time, 1));
        }

        return $response;
    }
}
