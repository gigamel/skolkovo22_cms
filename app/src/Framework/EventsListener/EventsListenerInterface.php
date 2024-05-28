<?php

namespace App\Framework\EventsListener;

interface EventsListenerInterface
{
    /**
     * @param string $name
     * @param string $eventClassName
     *
     * @return void
     */
    public function on(string $name, string $eventClassName): void;
    
    /**
     * @param string $name
     * @param mixed ...$args
     *
     * @return void
     */
    public function trigger(string $name, ...$args): void;
}
