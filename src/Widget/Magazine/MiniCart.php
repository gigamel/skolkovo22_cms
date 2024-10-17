<?php declare(strict_types=1);

namespace App\Widget\Magazine;

use App\Common\Frontend\View\Widget\Type\AbstractPhpWidget;
use App\Service\Magazine\CartRepository;

final class MiniCart extends AbstractPhpWidget
{
    public function __construct(
        private ?CartRepository $repository = null
    ) {
    }
    
    public function render(string $view, array $params = []): string
    {
        if (null === $this->repository) {
            return '';
        }
        
        return parent::render($view, $params);
    }
    
    protected function getSource(): string
    {
        return __DIR__ . '/view';
    }
}
