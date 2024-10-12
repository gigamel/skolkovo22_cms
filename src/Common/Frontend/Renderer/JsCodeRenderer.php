<?php declare(strict_types=1);

namespace App\Common\Frontend\Renderer;

final class JsCodeRenderer extends AbstractRenderer
{
    protected const string FORMAT = '<script%s>%s</script>';
    
    public function render(array $collection): string
    {
        $render = '';
        foreach ($collection as $file => $attrs) {
            unset($attrs['src']);
            $render .= sprintf(
                self::FORMAT,
                $this->renderAttrs($attrs),
                file_get_contents($file) ?: ''
            );
        }
        return $render;
    }
}
