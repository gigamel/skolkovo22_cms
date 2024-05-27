<?php

declare(strict_types=1);

namespace App\Admin\Provider;

use App\Framework\EventsListener\EventsListenerInterface;

interface EventsProviderInterface
{
    /**
     * @param EventsListenerInterface $eventsListener
     *
     * @return void
     */
    public function registerEvents(EventsListenerInterface $eventsListener): void;
}
