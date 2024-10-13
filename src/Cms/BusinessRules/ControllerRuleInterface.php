<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

use ReflectionClass;

interface ControllerRuleInterface
{
    /**
     * @throws Exception
     */
    public function check(ReflectionClass $controller): void;
}
