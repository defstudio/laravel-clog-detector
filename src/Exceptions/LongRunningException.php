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
    public static function tookLongerThanAllowed(float $elapsed_seconds, float $allowed_seconds): LongRunningException
    {
        return new self("Http request handling took $elapsed_seconds seconds, max time was $allowed_seconds seconds");
    }
}
