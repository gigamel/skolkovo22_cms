<?php declare(strict_types=1);

namespace App\Common\Http\Throwable;

use Exception;

interface ExceptionHandlerInterface
{
    public function handle(Exception $e): void;
}
