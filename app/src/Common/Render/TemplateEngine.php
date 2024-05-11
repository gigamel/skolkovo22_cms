<?php

declare(strict_types=1);

namespace App\Common\Render;

use App\Framework\Render\TemplateEngineInterface;

class TemplateEngine implements TemplateEngineInterface
{
    /** @var string */
    protected $content = '';
    
    /** @var string */
    protected $title = '';
    
    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $cssFile
     *
     * @return void
     */
    public function includeCSSCodeFromFile(string $cssFile): void
    {
        if (file_exists($cssFile)) {
            ob_start();
            require_once $cssFile;
            $cssCode = ob_get_contents();
            ob_end_clean();
            
            echo sprintf('<style>%s</style>', $cssCode);
        }
    }

    /**
     * @param string $jsFile
     * @param array $tagAttributes
     *
     * @return void
     */
    public function includeJsCodeFromFile(string $jsFile, array $tagAttributes = []): void
    {
        if (file_exists($cssFile)) {
            $attributes = '';
            foreach ($tagAttributes as $attribute => $attributeValue) {
                $attributes .= sprintf(' %s="%s"', $attribute, $attributeValue);
            }
            
            ob_start();
            require_once $jsCode;
            $jsCode = ob_get_contents();
            ob_end_clean();
            
            echo sprintf('<script%s>%s</script>', $attributes, $jsCode);
        }
    }
}
