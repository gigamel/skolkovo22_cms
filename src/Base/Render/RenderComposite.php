<?php

declare(strict_types=1);

namespace App\Base\Render;

use Gigamel\Frontend\View\Driver\PhpRenderDriver;
use Gigamel\Frontend\View\RenderDriverInterface;
use Gigamel\Frontend\View\RenderComposite as FrameworkRenderComposite;
use Gigamel\Frontend\View\RenderCompositeInterface;

final class RenderComposite implements RenderCompositeInterface
{
    private RenderCompositeInterface $renderComposite;

    public function __construct(private readonly string $source)
    {
        $this->renderComposite = new FrameworkRenderComposite();
        $this->setDriver(new PhpRenderDriver());
    }

    public function setDriver(RenderDriverInterface $driver): void
    {
        $this->renderComposite->setDriver($driver);
    }

    public function render(string $view, array $vars = []): string
    {
        return $this->renderComposite->render($this->source . '/' . $view, $vars);
    }
}
