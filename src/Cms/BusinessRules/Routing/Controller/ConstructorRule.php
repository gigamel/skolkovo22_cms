<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Routing\Controller;

use App\Cms\BusinessRules\Exception;
use App\Cms\BusinessRules\Routing\ControllerRuleInterface;
use App\Cms\Http\Controller\AbstractController;
use ReflectionClass;

final class ConstructorRule implements ControllerRuleInterface
{
    private const string MESSAGE = 'Controller [%s] must be instanceof [%s]';
    private const string MESSAGE_CONSTRUCTOR = '%s::__construct %s';
    
    /**
     * @inheritDoc
     */
    public function check(ReflectionClass $controller): void
    {
        if (!$constructor = $controller->getConstructor()) {
            return;
        }
        
        if ($constructor->isAbstract()) {
            throw new Exception(
                sprintf(
                    self::MESSAGE_CONSTRUCTOR,
                    $controller->getName(),
                    'must not be ABSTRACT'
                ),
                Exception::CODE_ACTION
            );
        }
        
        if (!$constructor->isPublic()) {
            throw new Exception(
                sprintf(
                    self::MESSAGE_CONSTRUCTOR,
                    $controller->getName(),
                    'must be PUBLIC'
                ),
                Exception::CODE_ACTION
            );
        }
    }
}
