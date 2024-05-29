<?php

declare(strict_types=1);

namespace modules\estate\src\controller\admin;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class EstateController extends AbstractController
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function list(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/list.php');
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function add(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/form.php');
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function delete(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/delete.php');
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function show(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/form.php');
    } 
}
