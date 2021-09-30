<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpPureAttributeCanBeAddedInspection */

namespace DefStudio\ClogDetector\Exceptions;

use Exception;

class LongRunningException extends Exception
{
    public static function httpRequestTookLongerThanAllowed(float $elapsedSeconds, float $allowedSeconds): LongRunningException
    {
        $elapsedSeconds = round($elapsedSeconds, 2);
        $allowedSeconds = round($allowedSeconds, 2);
        return new self("Last request took $elapsedSeconds seconds, max time was $allowedSeconds seconds");
    }
}
