<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

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
