<?php

declare(strict_types=1);

namespace App\Admin\Common;

use App\Framework\Http\Routing\RouterInterface;

abstract class AbstractController
{
    /** @var RouterInterface */
    protected $router;
    
    /**
     * @param RouterInterface $router
     *
     * @return void
     */
    final public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }
    
    final public function setTemplateEngine()
    {
        
    }
}
