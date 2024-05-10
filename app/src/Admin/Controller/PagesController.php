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
        return new Response('LIST');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function add(ClientMessageInterface $request): ServerMessageInterface
    {
        return new Response('ADD');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function delete(ClientMessageInterface $request): ServerMessageInterface
    {
        return new Response('DELETE');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function show(ClientMessageInterface $request): ServerMessageInterface
    {
        return new Response('SHOW');
    }
}
