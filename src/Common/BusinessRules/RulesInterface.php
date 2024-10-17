<?php declare(strict_types=1);

namespace App\Common\BusinessRules;

interface RulesInterface
{
    public function getArguments(): array;
    
    public function getRules(): array;
}
