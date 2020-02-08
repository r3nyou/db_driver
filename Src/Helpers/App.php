<?php

namespace App\Helpers;

class App
{
    private $config = [];

    public function __construct()
    {
        $this->config = Config::get('app');
    }

    public function isDebugMode(): bool
    {
        return $this->config['debug'] ?? false;
    }

    public function getEnvironment(): string
    {
        return $this->isTestMode() ? 'test' : $this->config['env'] ?? 'production';
    }

    public function getLogPath(): string
    {
        if (! isset($this->config['log_path'])) {
            throw new \Exception('Log path is not defined');
        }

        return $this->config['log_path'];
    }

    public function isRunningFromConsole(): bool
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpbg';
    }

    public function getServerTime(): \DateTimeInterface
    {
        return new \DateTime('now', new \DateTimeZone('Asia/Taipei'));
    }

    public function isTestMode(): bool
    {
        if (
            $this->isRunningFromConsole() &&
            defined('PHPUNIT_RUNNING') && 
            PHPUNIT_RUNNING == true
        ) {
            return true;
        }

        return false;
    }
}
