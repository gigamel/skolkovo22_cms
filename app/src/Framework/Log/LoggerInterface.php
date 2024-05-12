<?php

declare(strict_types=1);

namespace App\Framework\Log;

interface LoggerInterface
{
    /**
     * @param string $message
     *
     * @return void
     */
    public function error(string $message): void;
}
