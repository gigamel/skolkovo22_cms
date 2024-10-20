<?php declare(strict_types=1);

namespace App\Common\Config;

final class AppPaths
{
    private string $configPath;

    private string $themePath;

    private string $viewPath;

    public function __construct(private readonly string $basePath)
    {
        $this->configPath = sprintf('%s/config', $this->basePath);
        $this->themePath = sprintf('%s/theme', $this->basePath);
        $this->viewPath = sprintf('%s/view', $this->basePath);
    }

    public function getConfigPath(): string
    {
        return $this->configPath;
    }

    public function getThemePath(): string
    {
        return $this->themePath;
    }

    public function getViewPath(): string
    {
        return $this->viewPath;
    }
}
