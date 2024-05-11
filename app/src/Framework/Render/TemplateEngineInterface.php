<?php

namespace App\Framework\Render;

interface TemplateEngineInterface
{
    /**
     * @return string
     */
    public function getContent(): string;
    
    /**
     * @return string
     */
    public function getTitle(): string;
    
    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent(string $content): void;
    
    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void;
    
    /**
     * @param string $cssFile
     *
     * @return void
     */
    public function includeCSSCodeFromFile(string $cssFile): void;
    
    /**
     * @param string $jsFile
     * @param array $tagAttributes
     *
     * @return void
     */
    public function includeJsCodeFromFile(string $jsFile, array $tagAttributes = []): void;
}
