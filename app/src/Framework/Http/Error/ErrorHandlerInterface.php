<?php

declare(strict_types=1);

namespace App\Framework\Http\Error;

use App\Framework\Http\Protocol\ServerMessageInterface;
use Error;

interface ErrorHandlerInterface
{
    /**
     * @param Error $e
     *
     * @return ServerMessageInterface
     */
    public function handle(Error $e): ServerMessageInterface;
}
