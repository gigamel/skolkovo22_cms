<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

class Exception extends \Exception
{
    public const int CODE_CONTROLLER = 5;
    public const int CODE_ACTION = 10;
    
    public function __construct(
        string $message,
        int $code = 0,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
