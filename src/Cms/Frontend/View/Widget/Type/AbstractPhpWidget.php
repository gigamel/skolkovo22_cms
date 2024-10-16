<?php declare(strict_types=1);

namespace App\Cms\Frontend\View\Widget\Type;

use App\Cms\Frontend\View\Widget\AbstractWidget;
use App\Cms\Frontend\View\Type\PhpView;

abstract class AbstractPhpWidget extends AbstractWidget
{
    abstract protected function getSource(): string;
    
    public function render(string $view, array $params = []): string
    {
        return (new PhpView($this->getSource()))->render($view, $params);
    }
}
