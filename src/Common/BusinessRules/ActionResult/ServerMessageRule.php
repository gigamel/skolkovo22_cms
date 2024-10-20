<?php declare(strict_types=1);

namespace App\Common\BusinessRules\ActionResult;

use App\Common\BusinessRules\ActionResultRuleInterface;
use App\Common\BusinessRules\Exception;
use Sklkv22\Http\Protocol\ServerMessageInterface;
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
