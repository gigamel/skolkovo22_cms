<?php

declare(strict_types=1);

namespace App\Common\Browser;

final class Url
{
    /** @var string */
    private static $path;
    
    /** @var string */
    private static $webRoot;
    
    /**
     * @return string
     */
    public static function webRoot(): string
    {
        return self::$webRoot ?? '';
    }
    
    /**
     * @param string $webRoot
     *
     * @return void
     */
    public static function setUpWebRoot(string $webRoot): void
    {
        if (is_null(self::$webRoot)) {
            self::$webRoot = $webRoot;
        }
    }
    
    /**
     * @return string
     */
    public static function path(): string
    {
        if (is_null(self::$path)) {
            self::$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
        
        return self::$path;
    }
    
    /**
     * @param string $path
     *
     * @return string
     */
    public static function buildPath(string $path): string
    {
        return rtrim(self::webRoot(), '/') . '/' . ltrim($path, '/');
    }
}
