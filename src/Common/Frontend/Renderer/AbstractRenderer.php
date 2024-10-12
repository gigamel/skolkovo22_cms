<?php declare(strict_types=1);

namespace App\Common\Frontend\Renderer;

abstract class AbstractRenderer
{
    abstract public function render(array $collection): string;
    
    protected function renderAttrs(array $attrs): string
    {
        $html = '';
        foreach ($attrs as $attr => $value) {
            $html .= $this->renderAttr($attr, $value);
        }
        return $html;
    }
    
    protected function renderAttr(string $attr, string $value): string
    {
        return sprintf(' %s="%s"', $attr, $value);
    }
}
