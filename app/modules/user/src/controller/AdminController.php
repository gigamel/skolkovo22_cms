<?php

declare(strict_types=1);

namespace modules\user\src\controller;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Service\User\UserRepository;

final class AdminController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function list(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render(
        'users/list.php',
            [
                'users' => $this->userRepository->getList()
            ]
        );
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function show(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render(
        'users/form.php',
            [
                'user' => $this->userRepository->getById((int)$request->getAttribute('id'))
            ]
        );
    }

/**
    * @param ClientMessageInterface $request
    *
    * @return ServerMessageInterface
    */
    public function delete(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('users/delete.php');
    }

/**
    * @param ClientMessageInterface $request
    *
    * @return ServerMessageInterface
    */
    public function add(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('users/new.php');
    }
}
