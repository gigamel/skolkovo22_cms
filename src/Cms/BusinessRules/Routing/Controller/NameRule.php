<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Routing\Controller;

use App\Cms\BusinessRules\Exception;
use App\Cms\BusinessRules\Routing\ControllerRuleInterface;
use ReflectionClass;

final class NameRule implements ControllerRuleInterface
{
    private const string MESSAGE = 'Controller name must be ends with Controller. Actual [%s]';
    
    /**
     * @inheritDoc
     */
    public function check(ReflectionClass $controller): void
    {
        if (!str_ends_with($controller->getName(), 'Controller')) {
            throw new Exception(
                sprintf(
                    self::MESSAGE,
                    $controller->getName()
                ),
                Exception::CODE_CONTROLLER
            );
        }
    }
}
