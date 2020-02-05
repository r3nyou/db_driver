<?php

namespace App\Exception;

use Throwable;
use App\Helpers\App;

class ExceptionHandler
{
    public function handle(Throwable $t): void
    {
        $application = new App;
        if ($application->isDebugMode()) {
            var_dump($t);
        } else {
            echo 'This should not happened, please try again';
        }
        exit;
    }

    public function convertWarningAndNotice($severity, $message, $file, $line)
    {
        throw new \ErrorException($message, $severity, $severity, $file, $line);
    }
}
