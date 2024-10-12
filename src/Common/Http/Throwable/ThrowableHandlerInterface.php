<?php declare(strict_types=1);

namespace App\Common\Http\Throwable;

use Throwable;

interface ThrowableHandlerInterface
{
    public function handle(Throwable $e): void;
}
