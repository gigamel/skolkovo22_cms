<?php declare(strict_types=1);

namespace App\Common\Frontend\Assets;

use Override;

class CssCollection extends AbstractCollection
{
    #[Override]
    public function add(string $name, string $file, array $attrs = []): void
    {
        if (str_ends_with($file, '.css')) {
            parent::add($name, $file, $attrs);
        }
    }
}
