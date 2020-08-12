<?php

namespace Timmoh\MailcoachCustomPlaceholder\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../database/factories');
        $this->withoutExceptionHandling();
    }
}
