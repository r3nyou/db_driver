<?php

// declare(strict_type = 1);

use App\Exception\ExceptionHandler;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Src/Exception/exception.php';

$db = new mysqli('sdfas', 'root', '', 'bug');
$config = \App\Helpers\Config::get('adf');

$application = new \App\Helpers\App();

echo $application->isDebugMode() . PHP_EOL;
echo $application->getEnvironment() . PHP_EOL;
echo $application->getLogPath() . PHP_EOL;
echo $application->isRunningFromConsole() . PHP_EOL;
echo $application->getServerTime()->format('Y-m-d H:i:s') . PHP_EOL;