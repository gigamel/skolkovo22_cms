<?php declare(strict_types=1);

namespace App\Common\Frontend;

use App\Common\Frontend\Renderer\AbstractRenderer;
use App\Common\Frontend\Renderer\CssCodeRenderer;
use App\Common\Frontend\Renderer\JsCodeRenderer;
use App\Common\Frontend\Renderer\CssRenderer;
use App\Common\Frontend\Renderer\JsRenderer;

final class RendererFactory
{
    public static function cssCode(): AbstractRenderer
    {
        return new CssCodeRenderer();
    }
    
    public static function jsFiles(): AbstractRenderer
    {
        return new JsRenderer();
    }
    
    public static function cssFiles(): AbstractRenderer
    {
        return new CssRenderer();
    }
    
    public static function jsCode(): AbstractRenderer
    {
        return new JsCodeRenderer();
    }
}

