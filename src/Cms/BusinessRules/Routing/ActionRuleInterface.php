<?php declare(strict_types=1);

namespace App\Cms\BusinessRules\Routing;

use App\Cms\BusinessRules\Exception;
use ReflectionMethod;

interface ActionRuleInterface
{
    /**
     * @throws Exception
     */
    public function check(ReflectionMethod $action): void;
}
