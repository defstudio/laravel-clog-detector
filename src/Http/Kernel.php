<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\ClogDetector\Http;

use DefStudio\ClogDetector\Exceptions\LongRunningException;
use Symfony\Component\HttpFoundation\Response;

class Kernel extends \App\Http\Kernel
{
    public function handle($request): \Illuminate\Http\Response|Response
    {
        $start = microtime(true);
        $response = parent::handle($request);
        $execution_time = microtime(true) - $start;

        if ($execution_time > 1) {
            report(LongRunningException::tookLongerThanAllowed($execution_time, 1));
        }

        return $response;
    }

}
