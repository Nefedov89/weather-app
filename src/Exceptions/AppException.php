<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class AppException extends \Exception
{
    public const ADDITIONAL_INFO_ERROR_MESSAGE = PHP_EOL.'Check details on https://openweathermap.org/current';
}
