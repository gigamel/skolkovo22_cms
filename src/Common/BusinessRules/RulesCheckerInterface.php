<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

interface RulesCheckerInterface
{
    /**
     * @throws Exception
     */
    public function check(RulesInterface $businessRules): void;
}
