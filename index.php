<?php

// declare(strict_type = 1);

require_once __DIR__.'/vendor/autoload.php';

$application = new \App\Helpers\App();

echo $application->isDebugMode() . PHP_EOL;
echo $application->getEnvironment() . PHP_EOL;
echo $application->getLogPath() . PHP_EOL;
echo $application->isRunningFromConsole() . PHP_EOL;
echo $application->getServerTime()->format('Y-m-d H:i:s') . PHP_EOL;