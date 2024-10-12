<?php declare(strict_types=1);

namespace App\Cms;

use App\Cms\Http\Controller\AbstractController;
use Exception;
use ReflectionMethod;

final class BusinessRules
{
    public function checkController(string $controller): void
    {
    }
    
    public function checkAction(string|object $controller, string $action): void
    {
    }
}
