<?php

declare(strict_types=1);

use DefStudio\ClogDetector\Middleware\MeasureHttpResponseTime;

return [
    'slow_responses' => [
        /*
         * Enables slow responses reporting
         */
        'report' => env('SLOW_RESPONSES_REPORT', false),

        /*
         * Max http request handling time expressed in seconds.
         */
        'threshold' => env('SLOW_RESPONSES_MAX_SECS', 5),

        /*
         * Route names that will not report a long execution time.
         */
        'ignored_routes' => [
        ],

        /*
         * Urls that will not report a long execution time.
         */
        'ignored_urls' => [
        ],

        /*
         * The middleware to be used to check response times.
         * it must implement DefStudio\ClogDetector\Contracts\MeasureHttpResponseTime
         */
        'middleware' => MeasureHttpResponseTime::class,
    ],
];
