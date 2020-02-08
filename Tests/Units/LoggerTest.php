<?php

namespace Tests\Units;

use App\Helpers\App;
use App\Logger\Logger;
use App\Logger\LogLevel;
use PHPUnit\Framework\TestCase;
use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgument;

class LoggerTest extends TestCase
{
    /**
     * @var Logger
     */
    private $logger;

    public function setUp()
    {
        $this->logger = new Logger();
        parent::setUp();
    }

    public function testItImplementsLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    public function testItCanCreateDifferentTypesOfLogLevel()
    {
        $this->logger->info('Testing info logs');
        $this->logger->error('Testing error logs');
        $this->logger->log(LogLevel::ALERT, 'Testing Alert logs');
        
        $app = new App();
        $fileName = sprintf(
            "%s/%s-%s.log", $app->getLogPath(), $app->getEnvironment(), date('j.n.Y')
        );

        self::assertFileExists($fileName);

        $contentOfLogFile = file_get_contents($fileName);
        self::assertStringContainsString('Testing info logs', $contentOfLogFile);
        self::assertStringContainsString('Testing error logs', $contentOfLogFile);
        self::assertStringContainsString('Testing Alert logs', $contentOfLogFile);

        unlink($fileName);
        self::assertFileNotExists($fileName);
    }

    public function testItThrowsInvalidLogLevelArgumentWhenGivenAWrongLogLevel()
    {
        self::expectException(InvalidLogLevelArgument::class);
        $this->logger->log('Invalid', 'Testing Invalid log level');
    }
}