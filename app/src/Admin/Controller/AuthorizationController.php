<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;

class AuthorizationController extends AbstractController
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
