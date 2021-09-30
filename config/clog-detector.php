<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */


return [
    'max_http_seconds' => env('MAX_HTTP_RESPONSE_TIME_SECS', 5),

    'ignored_routes' => [
        //... ignored routes will not be checked for request times
    ],
];
