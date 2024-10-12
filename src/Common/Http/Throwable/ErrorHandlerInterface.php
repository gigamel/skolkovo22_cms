<?php declare(strict_types=1);

namespace App\Common\Http\Throwable;

use Error;

interface ErrorHandlerInterface
{
    public function handle(Error $e): void;
}
