<?php declare(strict_types=1);

namespace App\Common\Frontend\View\Widget\Type;

use App\Common\Frontend\View\Widget\AbstractWidget;
use App\Common\Frontend\View\Type\PhpView;

abstract class AbstractPhpWidget extends AbstractWidget
{
    abstract protected function getSource(): string;
    
    public function render(string $view, array $params = []): string
    {
        return (new PhpView($this->getSource()))->render($view, $params);
    }
}
