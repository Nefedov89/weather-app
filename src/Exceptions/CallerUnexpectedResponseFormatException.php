<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class CallerUnexpectedResponseFormatException extends AppException
{
    public const DEFAULT_ERROR_MESSAGE = 'Unexpected response format';

    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = self::DEFAULT_ERROR_MESSAGE.self::ADDITIONAL_INFO_ERROR_MESSAGE,
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
