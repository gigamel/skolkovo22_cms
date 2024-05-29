<?php

declare(strict_types=1);

namespace modules\user\src\controller;

use App\Admin\Common\AbstractController;
use App\Service\User\UserRepository;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

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
