<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Base\Service\ObservableInterface;
use App\Event\BeforeRoutingEvent;
use App\Event\RoutesCollectionEvent;
use App\Event\RouteFoundEvent;
use App\Service\Auth\Observer\LogoutPage;
use App\Service\Auth\Observer\IsAuthPath;
use App\Service\Auth\Observer\StartSession;
use Gigamel\Event\EventsObserverInterface;

final class Provider implements ObservableInterface
{
    public function addObservers(EventsObserverInterface $observers): void
    {
        $observers->addObserver(BeforeRoutingEvent::class, StartSession::class);
        $observers->addObserver(RouteFoundEvent::class, IsAuthPath::class);
        $observers->addObserver(RoutesCollectionEvent::class, LogoutPage::class);
    }
}
