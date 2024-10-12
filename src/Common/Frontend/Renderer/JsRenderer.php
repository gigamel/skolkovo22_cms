<?php declare(strict_types=1);

namespace App\Common\Frontend\Renderer;

final class JsRenderer extends AbstractRenderer
{
    protected const string FORMAT = '<script%s>%s</script>';
    
    public function render(array $collection): string
    {
        $render = '';
        foreach ($collection as $file => $attrs) {
            unset($attrs['src']);
            $attrs['src'] = $file;
            
            $render .= sprintf(
                self::FORMAT,
                $this->renderAttrs($attrs),
                ''
            );
        }
        return $render;
    }
}
