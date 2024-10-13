<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

use App\Cms\BusinessRules\Exception;
use App\Cms\BusinessRules\Routing\ActionResultRuleInterface;

final class ActionResultRules
{
    private array $rules = [];
    
    public function addRule(ActionResultRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
    
    /**
     * @throws Exception
     */
    public function check(
        string $controller,
        string $action,
        mixed $result
    ): void {
        foreach ($this->rules as $rule) {
            $rule->check($controller, $action, $result);
        }
    }
}
