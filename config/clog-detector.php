<?php
declare(strict_types=1);

return [
    'slow_responses' => [
        /*
         * Enables slow responses reporting
         */
        'report'           => env('SLOW_RESPONSES_REPORT', false),

        /*
         * Max http request handling time expressed in seconds.
         */
        'max_allowed_seconds' => env('SLOW_RESPONSES_MAX_SECS', 5),

        /*
         * Route names that will not report a long execution time.
         */
        'ignored_routes'   => [
        ],

        /*
         * Rrls that will not report a long execution time.
         */
        'ignored_urls'     => [
        ],
    ],
];
