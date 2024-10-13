<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\ActionResult;

use App\Cms\BusinessRules\ActionResultRuleInterface;
use App\Cms\BusinessRules\Exception;
use App\Common\Http\Protocol\ServerMessageInterface;
use ReflectionClass;

final class ServerMessageRule implements ActionResultRuleInterface
{
    private const string MESSAGE = 'Action %s::%s must returns %s';
    
    /**
     * @inheritDoc
     */
    public function check(
        string $controller,
        string $action,
        mixed $result
    ): void {
        if (is_object($result) && $result instanceof ServerMessageInterface) {
            return;
        }
        
        throw new Exception(
            sprintf(
                self::MESSAGE,
                $controller,
                $action,
                ServerMessageInterface::class
            )
        );
    }
}
