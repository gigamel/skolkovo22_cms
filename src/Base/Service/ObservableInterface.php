<?php

declare(strict_types=1);

namespace App\Base\Service;

use Gigamel\Event\EventsObserverInterface;

interface ObservableInterface
{
    public function addObservers(EventsObserverInterface $observers): void;
}
