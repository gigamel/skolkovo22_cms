<?php declare(strict_types=1);

namespace App\Module\Magazine\Widget\Cart;

use App\Common\Frontend\View\Widget\Type\AbstractPhpWidget;
use App\Module\Magazine\Service\CartRepository;

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
