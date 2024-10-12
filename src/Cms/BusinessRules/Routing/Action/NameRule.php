<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Routing\Action;

use App\Cms\BusinessRules\Exception;
use App\Cms\BusinessRules\Routing\ActionRuleInterface;
use ReflectionMethod;

final class NameRule implements ActionRuleInterface
{
    private const array BAD_NAMES = [
        'render',
        'createServerMessage',
    ];
    
    private const string MESSAGE = 'Invalid action name [%s]. Bad names: [%s]';
    
    /**
     * @inheritDoc
     */
    public function check(ReflectionMethod $action): void
    {
        if (\in_array($action->getName(), self::BAD_NAMES, true)) {
            throw new Exception(
                sprintf(
                    self::MESSAGE,
                    $action->getName(),
                    implode(', ', self::BAD_NAMES)
                ),
                Exception::CODE_ACTION
            );
        }
    }
}
