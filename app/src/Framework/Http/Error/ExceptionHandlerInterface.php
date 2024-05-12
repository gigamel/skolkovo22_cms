<?php

declare(strict_types=1);

namespace App\Framework\Http\Error;

use App\Framework\Http\Protocol\ServerMessageInterface;
use Exception;

interface ExceptionHandlerInterface
{
    /**
     * @param Exception $e
     *
     * @return ServerMessageInterface
     */
    public function handle(Exception $e): ServerMessageInterface;
}
