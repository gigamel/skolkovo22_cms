<?php

declare(strict_types=1);

namespace modules\estate\src\controller\admin;

use App\Admin\Common\AbstractController;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class CategoryController extends AbstractController
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function list(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/category/list.php');
    }
                
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function add(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/category/form.php');
    }
                
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function delete(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/category/delete.php');
    }
                
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function show(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('estates/category/form.php');
    }
}
