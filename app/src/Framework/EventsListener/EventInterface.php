<?php

declare(strict_types=1);

namespace App\Framework\EventsListener;

interface EventInterface
{
    /**
     * @return bool
     */
    public function stopPropagation(): bool;
    
    /**
     * @return void
     */
    public function handle(): void;
}
