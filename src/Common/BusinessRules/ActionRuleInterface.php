<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

use ReflectionMethod;

interface ActionRuleInterface
{
    /**
     * @throws Exception
     */
    public function check(ReflectionMethod $action): void;
}
