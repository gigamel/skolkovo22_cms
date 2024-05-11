<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;

class DashboardController extends AbstractController
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function dashboard(ClientMessageInterface $request): ServerMessageInterface
    {
        return new Response('DASHBOARD');
    }
}
