<?php

/** @noinspection PhpPureAttributeCanBeAddedInspection */

declare(strict_types=1);

namespace DefStudio\ClogDetector\Exceptions;

class WrongConfigurationException extends \Exception
{
    public static function wrong_contract_used(string $config_key, string $required_contract): WrongConfigurationException
    {
        return new self("$config_key class in configuration must implement $required_contract");
    }
}
