<?php

// declare(strict_type = 1);

use App\Exception\ExceptionHandler;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Src/Exception/exception.php';

$logger = new \App\Logger\Logger();
$logger->log(
    \App\Logger\LogLevel::EMERGENCY, 'There is an emergency', ['exception' => 'exception occured']
);

// $logger->info('User account created successfully', ['id' => 5]);