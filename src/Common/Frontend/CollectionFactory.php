<?php declare(strict_types=1);

namespace App\Common\Frontend;

use App\Common\Frontend\Assets\AbstractCollection;
use App\Common\Frontend\Assets\CssCodeCollection;
use App\Common\Frontend\Assets\JsCodeCollection;
use App\Common\Frontend\Assets\CssCollection;
use App\Common\Frontend\Assets\JsCollection;

final class CollectionFactory
{
    public static function cssCode(): AbstractCollection
    {
        return new CssCodeCollection();
    }
    
    public static function jsFiles(): AbstractCollection
    {
        return new JsCollection();
    }
    
    public static function cssFiles(): AbstractCollection
    {
        return new CssCollection();
    }
    
    public static function jsCode(): AbstractCollection
    {
        return new JsCodeCollection();
    }
}

