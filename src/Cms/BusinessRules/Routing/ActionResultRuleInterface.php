<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Routing;

use App\Cms\BusinessRules\Exception;

interface ActionResultRuleInterface
{
    /**
     * @throws Exception
     */
    public function check(
        string $controller,
        string $action,
        mixed $result
    ): void;
}
