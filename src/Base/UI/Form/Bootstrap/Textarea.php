<?php

declare(strict_types=1);

namespace App\Base\UI\Form\Bootstrap;

use Gigamel\Form\Field\Textarea as FrameworkTextarea;

final class Textarea extends FrameworkTextarea
{
    public function render(): string
    {
        return sprintf('<div class="mb-3">%s</div>', parent::render());
    }
}
