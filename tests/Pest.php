<?php

declare(strict_types=1);

use DefStudio\ClogDetector\Tests\TestCase;

uses(TestCase::class)->in('Unit');

function bind_mock(string $class, callable ...$methods)
{
    $mock = mock($class)->expect(...$methods);
    app()->bind($class, fn () => $mock);
}
