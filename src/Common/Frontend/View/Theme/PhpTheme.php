<?php declare(strict_types=1);

namespace App\Common\Frontend\View\Theme;

use App\Common\Frontend\View\ThemeInterface;
use App\Common\Frontend\View\Type\PhpView;

final class PhpTheme implements ThemeInterface
{
    private array $js = [];
    
    private array $css = [];
    
    private bool $rendered = false;
    
    public function __construct(
        private readonly string $source,
        private readonly string $name,
        private readonly string $viewSource
    ) {
    }
    
    public function render(string $view, array $vars = []): string
    {
        if ($this->rendered) {
            return '';
        }
        
        $this->rendered = true;
        
        return $this->renderPhpView(
            $this->source,
            $this->name,
            [
                'theme' => $this,
                'content' => $this->renderPhpView(
                    $this->viewSource,
                    $view,
                    [...$vars, 'theme' => $this]
                ),
            ]
        );
    }
    
    public function addJs(string $group, string $src): void
    {
        $this->js[$group][] = $src;
    }
    
    public function addCss(string $group, string $href): void
    {
        $this->css[$group][] = $href;
    }
    
    public function js(string $group, array $attrs = []): void
    {
        if ($this->js[$group] ?? false) {
            $code = '';
            foreach ($this->js[$group] as $src) {
                $code .= file_exists($src) ? (file_get_contents($src) ?: '') : '';
            }
            
            if ($code) {
                echo sprintf('<script>%s</script>', $code);
            }
            
            unset($this->js[$group]);
        }
    }
    
    public function css(string $group, array $attrs = []): void
    {
        if ($this->css[$group] ?? false) {
            $code = '';
            foreach ($this->css[$group] as $href) {
                $code .= file_exists($href) ? (file_get_contents($href) ?: '') : '';
            }
            
            if ($code) {
                echo sprintf('<style>%s</style>', $code);
            }
            
            unset($this->css[$group]);
        }
    }
    
    private function renderPhpView(string $source, string $view, array $vars = []): string
    {
        return (new PhpView($source))->render($view, $vars);
    }
}
