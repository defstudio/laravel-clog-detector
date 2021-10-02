<?php

namespace DefStudio\ClogDetector\Tests;

use DefStudio\ClogDetector\ClogDetectorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ClogDetectorServiceProvider::class,
        ];
    }
}
