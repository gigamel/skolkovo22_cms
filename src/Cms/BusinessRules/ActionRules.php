<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

use App\Cms\BusinessRules\Exception;
use App\Cms\BusinessRules\Routing\ActionRuleInterface;
use ReflectionMethod;

final class ActionRules
{
    /** @var list<ActionRuleInterface> */
    private array $rules = [];
    
    public function addRule(ActionRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
    
    /**
     * @throws Exception
     */
    public function check(string|object $class, string $action): void
    {
        if (!$this->rules) {
            return;
        }
        
        $reflectionMethod = new ReflectionMethod($class, $action);
        
        foreach ($this->rules as $rule) {
            $rule->check($reflectionMethod);
        }
    }
}
