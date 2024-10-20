<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

use ReflectionMethod;

final class ActionRules implements RulesInterface
{
    private array $rules = [];
    
    public function __construct(
        private string $controller,
        private string $action
    ) {
    }
    
    public function addRule(ActionRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
    
    public function getRules(): array
    {
        return [
            new \App\Common\BusinessRules\Action\ModifiersRule(),
            new \App\Common\BusinessRules\Action\NameRule(),
        ];
    }
    
    public function getArguments(): array
    {
        return [
            new ReflectionMethod($this->controller, $this->action),
        ];
    }
}
