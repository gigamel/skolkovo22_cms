<?php

namespace App\Framework\Http;

use RuntimeException;
use Throwable;

class HttpException extends RuntimeException
{
    /**
     * @inheritDoc
     */
    public function __construct(
        string $message = 'Server Internal Error',
        int $code = 500,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
