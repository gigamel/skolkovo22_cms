<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

interface RulesCheckerInterface
{
    /**
     * @throws Exception
     */
    public function check(RulesInterface $businessRules): void;
}
