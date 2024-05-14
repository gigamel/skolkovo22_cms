<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;

class DashboardController extends AbstractController
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function dashboard(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('dashboard/dashboard.php');
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function settings(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('dashboard/settings.php');
    }
}
