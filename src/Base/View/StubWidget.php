<?php

declare(strict_types=1);

namespace App\Base\View;

final class StubWidget extends AbstractWidget
{
    public function __call(string $name, array $arguments = []): self
    {
        return $this;
    }
}
