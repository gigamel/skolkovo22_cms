<?php

declare(strict_types=1);

namespace App\Common\EventsListener;

use App\Framework\EventsListener\EventsListenerInterface;

class EventsListener implements EventsListenerInterface
{
    /** @var array */
    protected $_events = [];
    
    /**
     * @inheritDoc
     */
    public function on(string $name, callable $handler): void
    {
        if (!array_key_exists($name, $this->_events)) {
            $this->_events[$name] = [];
        }
        
        $this->_events[$name][] = $handler;
    }
    
    /**
     * @inheritDoc
     */
    public function trigger(string $name): void
    {
        if (array_key_exists($name, $this->_events)) {
            foreach ($this->_events[$name] as $handler) {
                call_user_func($handler);
            }
        }
    }
}
