<?php

declare(strict_types=1);

namespace DefStudio\ClogDetector\Middleware;

use Closure;
use DefStudio\ClogDetector\Exceptions\LongRunningException;
use URL;

class MeasureHttpResponseTime implements \DefStudio\ClogDetector\Contracts\MeasureHttpResponseTime
{
    private bool $enabled;

    private float $threshold;

    /** @var array<string> */
    private array $ignoredUrls;

    /** @var array<string> */
    private array $ignoredRoutes;

    public function __construct()
    {
        $this->enabled = false;
        $this->threshold = config('clog-detector.slow_responses.threshold') ?? 0;
        $this->ignoredRoutes = config('clog-detector.ignored_routes', []);
        $this->ignoredUrls = config('clog-detector.ignored_urls', []);
    }

    public function enabled(bool $enable = null): bool
    {
        if ($enable !== null) {
            $this->enabled = $enable;
        }

        return $this->enabled;
    }

    public function threshold(float $seconds = null): float
    {
        if ($seconds !== null) {
            $this->threshold = $seconds;
        }

        return $this->threshold;
    }

    public function handle($request, Closure $next): mixed
    {
        $response = $next($request);
        $completionTime = now()->timestamp;

        if (!$this->enabled) {
            return $response;
        }

        if ($this->threshold == 0) {
            return $response;
        }

        if ($request->routeIs(...$this->ignoredRoutes)) {
            return $response;
        }

        //@phpstan-ignore-next-line
        if (in_array(URL::current(), $this->ignoredUrls, true)) {
            return $response;
        }

        /** @var float $start */
        $start = $request->server('REQUEST_TIME_FLOAT');

        $executionTime = $completionTime - $start;

        if ($executionTime > $this->threshold) {
            report(LongRunningException::httpRequestTookLongerThanAllowed($executionTime ?? 0, $this->threshold));
        }

        return $response;
    }
}
