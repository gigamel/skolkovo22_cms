<?php

declare(strict_types=1);

namespace App\Common\Base;

final class Directory
{
    /** @var string|null */
    private static $applicationDirectory;

    private function __construct()
    {
    }

    /**
     * @param string $applicationDirectory
     *
     * @return void
     */
    public static function setup(string $applicationDirectory): void
    {
        if (is_null(self::$applicationDirectory)) {
            self::$applicationDirectory = $applicationDirectory;
        }
    }

    /**
     * @return string
     */
    public static function modules(): string
    {
        return self::$applicationDirectory . '/modules';
    }

    /**
     * @return string
     */
    public static function config(): string
    {
        return self::$applicationDirectory . '/config';
    }

    /**
     * @return string
     */
    public static function view(): string
    {
        return self::$applicationDirectory . '/view';
    }
    
    /**
     * @return string
     */
    public static function theme(): string
    {
        return self::$applicationDirectory . '/theme';
    }
    
    /**
     * @return string
     */
    public static function server(): string
    {
        return self::$applicationDirectory . '/server';
    }
}
