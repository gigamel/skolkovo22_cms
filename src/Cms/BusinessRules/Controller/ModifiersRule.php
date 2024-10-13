<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Controller;

use App\Cms\BusinessRules\ControllerRuleInterface;
use App\Cms\BusinessRules\Exception;
use ReflectionClass;

final class ModifiersRule implements ControllerRuleInterface
{
    private const string MESSAGE = 'Controller [%s] must not be ABSTRACT';
    
    /**
     * @inheritDoc
     */
    public function check(ReflectionClass $controller): void
    {
        if ($controller->isAbstract()) {
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