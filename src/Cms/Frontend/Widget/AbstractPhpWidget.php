<?php declare(strict_types=1);

namespace App\Cms\Frontend\Widget;

use App\Cms\Frontend\View\PhpView;

abstract class AbstractPhpWidget extends AbstractWidget
{
    abstract protected function getSource(): string;
    
    public function render(string $view, array $params = []): string
    {
        return (new PhpView($this->getSource()))->render($view, $params);
    }
}
