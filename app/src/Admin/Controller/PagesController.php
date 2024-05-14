<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use App\Admin\Common\AbstractController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;

class PagesController extends AbstractController
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function list(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('pages/list.php');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function add(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('pages/form.php');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function delete(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('pages/delete.php');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function show(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('pages/form.php');
    }
}
