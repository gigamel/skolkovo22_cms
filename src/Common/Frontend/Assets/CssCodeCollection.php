<?php declare(strict_types=1);

namespace App\Common\Frontend\Assets;

use Override;

final class CssCodeCollection extends CssCollection
{
    #[Override]
    public function add(string $name, string $file, array $attrs = []): void
    {
        if (file_exists($file)) {
            parent::add($name, $file, $attrs);
        }
    }
}
