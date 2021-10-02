<?php

/** @noinspection PhpPureAttributeCanBeAddedInspection */

declare(strict_types=1);

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
