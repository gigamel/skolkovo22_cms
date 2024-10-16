<?php declare(strict_types=1);

namespace App\Cms\Frontend\View;

final class PhpView implements ViewInterface
{
    public function __construct(
        protected readonly string $source
    ) {
    }
    
    public function render(string $view, array $params = []): string
    {
        $view = sprintf(
            '%s/%s',
            rtrim($this->source, '/'),
            ltrim($view, '/')
        );
        
        if (!\str_ends_with($view, '.php')) {
            return '';
        }
        
        if (!file_exists($view)) {
            return '';
        }
        
        extract($params);
        unset($param);
        
        ob_start();
        require $view;
        return ob_get_clean() ?: '';
    }
}
