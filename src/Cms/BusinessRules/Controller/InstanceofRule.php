<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Controller;

use App\Cms\BusinessRules\ControllerRuleInterface;
use App\Cms\BusinessRules\Exception;
use App\Cms\Http\Controller\AbstractController;
use ReflectionClass;

final class InstanceofRule implements ControllerRuleInterface
{
    private const string MESSAGE = 'Controller [%s] must be instanceof [%s]';
    
    /**
     * @inheritDoc
     */
    public function check(ReflectionClass $controller): void
    {
        if (!$controller->isSubclassOf(AbstractController::class)) {
            throw new Exception(
                sprintf(
                    self::MESSAGE,
                    $controller->getName(),
                    AbstractController::class
                ),
                Exception::CODE_CONTROLLER
            );
        }
    }
}
