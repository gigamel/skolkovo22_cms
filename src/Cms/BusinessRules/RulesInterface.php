<?php declare(strict_types=1);

namespace App\Cms\BusinessRules;

interface RulesInterface
{
    public function getArguments(): array;
    
    public function getRules(): array;
}
