<?php

declare(strict_types=1);

namespace App\Base\UI\Form\Bootstrap;

use Gigamel\Form\Field\InputText as FrameworkInputText;

final class InputText extends FrameworkInputText
{
    public function render(): string
    {
        return sprintf('<div class="mb-3">%s</div>', parent::render());
    }
}
