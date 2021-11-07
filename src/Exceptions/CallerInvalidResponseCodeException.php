<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class CallerInvalidResponseCodeException extends AppException
{
    public const DEFAULT_ERROR_MESSAGE = 'Invalid response code';

    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = '',
        $code = 0,
        Throwable $previous = null
    ) {
        if (!$message) {
            $message = self::DEFAULT_ERROR_MESSAGE;
        }

        $message .= self::ADDITIONAL_INFO_ERROR_MESSAGE;

        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}
