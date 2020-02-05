<?php
namespace App\Exception;

set_error_handler([new ExceptionHandler(), 'convertWarningAndNotice']);
set_exception_handler([new ExceptionHandler(), 'handle']);