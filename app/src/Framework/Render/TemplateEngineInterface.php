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
     * @param array $tagAttributes
     *
     * @return void
     */
    public function includeCSSFromFile(string $cssFile, array $tagAttributes = []): void;
    
    /**
     * @param string $jsFile
     * @param array $tagAttributes
     *
     * @return void
     */
    public function includeJsFromFile(string $jsFile, array $tagAttributes = []): void;
    
    /**
     * @param string $jsFile
     * @param array $tagAttributes
     *
     * @return void
     */
    public function includeJsCodeFromFile(string $jsFile, array $tagAttributes = []): void;
}
