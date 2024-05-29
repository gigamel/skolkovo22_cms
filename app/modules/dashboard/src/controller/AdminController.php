<?php

declare(strict_types=1);

namespace modules\dashboard\src\controller;

use App\Admin\Common\AbstractController;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class AdminController extends AbstractController
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

