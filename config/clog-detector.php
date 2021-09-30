<?php

return [

    /**
     * Max http request handling time expressed in seconds
     */
    'max_http_seconds' => env('MAX_HTTP_RESPONSE_TIME_SECS', 5),

    /**
     * route names that will not report a long execution time
     */
    'ignored_routes'   => [

    ],

    /**
     * urls that will not report a long execution time
     */
    'ignored_urls'     => [

    ],

];
