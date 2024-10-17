<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

use ReflectionClass;

final class ControllerRules implements RulesInterface
{
    private array $rules = [];
    
    public function __construct(
        private string $controller
    ) {
    }
    
    public function addRule(ControllerRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
    
    public function getRules(): array
    {
        return [
            new \App\Common\BusinessRules\Controller\NameRule(),
            new \App\Common\BusinessRules\Controller\ModifiersRule(),
            new \App\Common\BusinessRules\Controller\ConstructorRule(),
        ];
    }
    
    public function getArguments(): array
    {
        return [
            new ReflectionClass($this->controller),
        ];
    }
}
