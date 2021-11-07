<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class ArgumentParserException extends AppException
{
    public const DEFAULT_ERROR_MESSAGE = "Argument city \'-c\' or \'--city\' with its value is required";

    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = self::DEFAULT_ERROR_MESSAGE,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}
