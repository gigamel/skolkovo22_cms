<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

use ReflectionClass;

interface ControllerRuleInterface
{
    /**
     * @throws Exception
     */
    public function check(ReflectionClass $controller): void;
}
