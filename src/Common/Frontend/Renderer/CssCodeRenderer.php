<?php declare(strict_types=1);

namespace App\Common\Frontend\Renderer;

final class CssCodeRenderer extends AbstractRenderer
{
    protected const string FORMAT = '<style>%s</style>';
    
    public function render(array $collection): string
    {
        $render = '';
        foreach ($collection as $file => $attrs) {
            $render .= sprintf(
                self::FORMAT,
                file_get_contents($file) ?: ''
            );
        }
        return $render;
    }
}
