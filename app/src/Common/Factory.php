<?php

declare(strict_types=1);

namespace App\Common;

use App\Common\Dependency\Container;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\EventsListener\EventsListenerInterface;
use App\Common\EventsListener\EventsListener;

final class Factory
{
    /**
     * @return EventsListenerInterface
     */
    public static function createEventListener(): EventsListenerInterface
    {
        return new EventsListener();
    }
    
    /**
     * @return ContainerInterface
     */
    public static function createContaier(): ContainerInterface
    {
        return new Container();
    }
}
