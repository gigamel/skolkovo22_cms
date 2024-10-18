<?php declare(strict_types=1);

namespace App\Common\Frontend\View;

interface ThemeInterface extends ViewInterface
{
    public function addJs(string $group, string $src): void;
    
    public function addCss(string $group, string $href): void;
    
    public function js(string $group, array $attrs = []): void;
    
    public function css(string $group, array $attrs = []): void;
}
