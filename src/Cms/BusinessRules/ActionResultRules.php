<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

final class ActionResultRules implements RulesInterface
{
    private array $rules = [];
    
    public function __construct(
        private string $controller,
        private string $action,
        private mixed $result
    ) {
    }
    
    public function addRule(ActionResultRuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
    
    public function getRules(): array
    {
        return [
            new \App\Cms\BusinessRules\ActionResult\ServerMessageRule(),
        ];
    }
    
    public function getArguments(): array
    {
        return [
            $this->controller,
            $this->action,
            $this->result,
        ];
    }
}
