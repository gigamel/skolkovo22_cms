<?php declare(strict_types=1);

namespace App\Common\Frontend;

use App\Common\Frontend\AbstractCollection;
use App\Common\Frontend\Renderer\AbstractRenderer;

final class Assets
{
    private AbstractCollection $cssCodeCollection;
    
    private AbstractCollection $jsCodeCollection;
    
    private AbstractCollection $cssFilesCollection;
    
    private AbstractCollection $jsFilesCollection;
    
    private AbstractRenderer $cssCodeRenderer;
    
    private AbstractRenderer $jsCodeRenderer;
    
    private AbstractRenderer $cssFilesRenderer;
    
    private AbstractRenderer $jsFilesRenderer;
    
    public function __construct()
    {
        $this->cssCodeCollection = CollectionFactory::cssCode();
        $this->jsCodeCollection = CollectionFactory::jsCode();
        $this->cssFilesCollection = CollectionFactory::cssFiles();
        $this->jsFilesCollection = CollectionFactory::jsFiles();
        
        $this->cssCodeRenderer = RendererFactory::cssCode();
        $this->jsCodeRenderer = RendererFactory::jsCode();
        $this->cssFilesRenderer = RendererFactory::cssFiles();
        $this->jsFilesRenderer = RendererFactory::jsFiles();
    }
    
    public function addCssCode(string $name, string $file, array $attrs = []): void
    {
        $this->cssCodeCollection->add($name, $file, $attrs);
    }
    
    public function addCssFile(string $name, string $file, array $attrs = []): void
    {
        $this->cssFilesCollection->add($name, $file, $attrs);
    }
    
    public function addJsCode(string $name, string $file, array $attrs = []): void
    {
        $this->jsCodeCollection->add($name, $file, $attrs);
    }
    
    public function addJsFile(string $name, string $file, array $attrs = []): void
    {
        $this->jsFilesCollection->add($name, $file, $attrs);
    }
    
    public function script(string $name): void
    {
        echo $this->jsCodeRenderer->render($this->jsCodeCollection->getCollection($name));
    }
    
    public function style(string $name): void
    {
        echo $this->cssCodeRenderer->render($this->cssCodeCollection->getCollection($name));
    }
    
    public function srcScript(string $name): void
    {
        echo $this->jsFilesRenderer->render($this->jsFilesCollection->getCollection($name));
    }
    
    public function relLink(string $name): void
    {
        echo $this->cssFilesRenderer->render($this->cssFilesCollection->getCollection($name));
    }
}
