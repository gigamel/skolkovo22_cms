<?php

declare(strict_types=1);

namespace App\Framework\EventsListener;

class EventsListener implements EventsListenerInterface
{
    /** @var array */
    protected $_events = [];
    
    /**
     * @inheritDoc
     */
    public function on(string $name, string $eventClassName): void
    {
        if (!array_key_exists($name, $this->_events)) {
            $this->_events[$name] = [];
        }
        
        $this->_events[$name][] = $eventClassName;
    }
    
    /**
     * @inheritDoc
     */
    public function trigger(string $name, ...$args): void
    {
        if (array_key_exists($name, $this->_events)) {
            foreach ($this->_events[$name] as $eventClassName) {
                /** @var EventInterface $event */
                $event = new $eventClassName(...$args);
                $event->handle();
                
                if ($event->stopPropagation()) {
                    break;
                }
            }
        }
    }
}
