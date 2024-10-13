<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

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
            new \App\Cms\BusinessRules\Controller\NameRule(),
            new \App\Cms\BusinessRules\Controller\ModifiersRule(),
            new \App\Cms\BusinessRules\Controller\InstanceofRule(),
            new \App\Cms\BusinessRules\Controller\ConstructorRule(),
        ];
    }
    
    public function getArguments(): array
    {
        return [
            new ReflectionClass($this->controller),
        ];
    }
}
