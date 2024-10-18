<?php declare(strict_types=1);

namespace App\Common\Http\Routing;

interface ActionInterface
{
    public function getController(): string;
    
    public function getAction(): string;
}
