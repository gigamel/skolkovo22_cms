<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

class RulesChecker implements RulesCheckerInterface
{
    /**
     * @throws Exception
     */
    public function check(RulesInterface $businessRules): void
    {
        $rules = $businessRules->getRules();
        if (!$rules) {
            return;
        }
        
        $arguments = $businessRules->getArguments();
        
        foreach ($rules as $rule) {
            $rule->check(...array_values($arguments));
        }
    }
}
