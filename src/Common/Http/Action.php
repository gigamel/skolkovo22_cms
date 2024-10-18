<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Routing\ActionInterface;

class Action implements ActionInterface
{
    public function __construct(
        protected readonly string $controller,
        protected readonly string $action
    ) {
    }
    
    public function getController(): string
    {
        return $this->controller;
    }
    
    public function getAction(): string
    {
        return $this->action;
    }
}
