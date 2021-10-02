<?php

/** @noinspection PhpMissingParamTypeInspection */

declare(strict_types=1);

namespace DefStudio\ClogDetector\Contracts;

use Closure;
use Illuminate\Http\Request;

interface MeasureHttpResponseTime
{
    public function enabled(bool|null $enable = null): bool;

    public function threshold(float|null $seconds = null): float;

    /**
     * @param Request $request
     */
    public function handle($request, Closure $next): mixed;
}
