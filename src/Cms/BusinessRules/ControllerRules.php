<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

use App\Cms\BusinessRules\Exception;
use App\Cms\BusinessRules\Routing\ControllerRuleInterface;
use ReflectionClass;

final class ControllerRules
{
    /** @var list<ControllerRuleInteface> */
    private array $rules = [];
    
    public function addRule(ControllerRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
    
    /**
     * @throws Exception
     */
    public function check(string $class): void
    {
        if (!$this->rules) {
            return;
        }
        
        $reflectionClass = new ReflectionClass($class);
        
        foreach ($this->rules as $rule) {
            $rule->check($reflectionClass);
        }
    }
}
