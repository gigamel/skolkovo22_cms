<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Protocol\ServerMessageInterface;
use Exception;

class HttpException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = ServerMessageInterface::STATUS_INTERNAL_SERVER_ERROR,
        ?Exception $e = null
    ) {
        if (!in_array($code, ServerMessageInterface::STATUSES, true)) {
            $code = ServerMessageInterface::STATUS_INTERNAL_SERVER_ERROR;
        }
        
        if (empty($message)) {
            $message = ServerMessageInterface::MESSAGES[$code] ?? $message;
        }
        
        parent::__construct($message, $code, $e);
    }
}
