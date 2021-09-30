<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */


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
