<?php

namespace Tests\Units;

use PHPUnit\Framework\TestCase;
use App\Helpers\App;

class ApplicationTest extends TestCase
{
    public function testItCanGetInstanceOfApplication()
    {
        self::assertInstanceOf(App::class, new App);
    }

    public function testItCanGetBasicApplicationDatasetFromAppClass()
    {
        $app = new App();
        self::assertSame('test', $app->getEnvironment());
        self::assertNotNull($app->getLogPath());
        self::assertTrue($app->isRunningFromConsole());
        self::assertInstanceOf(\DateTime::class, $app->getServerTime());
        self::assertTrue($app->isTestMode());
    }
}
