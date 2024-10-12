<?php declare(strict_types=1);

namespace App\Common\Frontend\Renderer;

final class CssRenderer extends AbstractRenderer
{
    protected const string FORMAT = '<link%s />';
    
    public function render(array $collection): string
    {
        $render = '';
        foreach ($collection as $file => $attrs) {
            unset($attrs['rel']);
            unset($attrs['href']);
            
            $attrs['rel'] = 'stylesheet';
            $attrs['href'] = $file;
            
            $render .= sprintf(
                self::FORMAT,
                $this->renderAttrs($attrs)
            );
        }
        return $render;
    }
}
