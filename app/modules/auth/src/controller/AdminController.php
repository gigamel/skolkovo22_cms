<?php

declare(strict_types=1);

namespace modules\auth\src\controller;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;

class AdminController extends AbstractController
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function login(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('authorization/login.php');
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function logout(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('authorization/logout.php');
    }
}
