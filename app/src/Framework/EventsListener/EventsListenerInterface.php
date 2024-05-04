<?php

namespace App\Framework\EventsListener;

interface EventsListenerInterface
{
    /**
     * @param string $name
     * @param callable $handler
     *
     * @return void
     */
    public function on(string $name, callable $handler): void;
    
    /**
     * @param string $name
     *
     * @return void
     */
    public function trigger(string $name): void;
}
