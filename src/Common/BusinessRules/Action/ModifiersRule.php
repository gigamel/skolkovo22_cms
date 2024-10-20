<?php declare(strict_types=1);

namespace App\Common\BusinessRules\Action;

use App\Common\BusinessRules\ActionRuleInterface;
use App\Common\BusinessRules\Exception;
use ReflectionMethod;

final class ModifiersRule implements ActionRuleInterface
{
    private const array BAD_NAMES = [
        'render',
        'createServerMessage',
    ];
    
    private const string MESSAGE = 'Action %s::%s %s';
    
    /**
     * @inheritDoc
     */
    public function check(ReflectionMethod $action): void
    {
        if ($action->isAbstract()) {
            throw new Exception(
                sprintf(
                    self::MESSAGE,
                    $action->getDeclaringClass()->getName(),
                    $action->getName(),
                    'must not be ABSTRACT'
                ),
                Exception::CODE_ACTION
            );
        }
        
        if ($action->isStatic()) {
            throw new Exception(
                sprintf(
                    self::MESSAGE,
                    $action->getDeclaringClass()->getName(),
                    $action->getName(),
                    'must not be STATIC'
                ),
                Exception::CODE_ACTION
            );
        }
        
        if (!$action->isPublic()) {
            throw new Exception(
                sprintf(
                    self::MESSAGE,
                    $action->getDeclaringClass()->getName(),
                    $action->getName(),
                    'must be PUBLIC'
                ),
                Exception::CODE_ACTION
            );
        }
    }
}
