<?php

declare(strict_types=1);

namespace App\Framework\Http\Routing;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getRule(): string;

    /**
     * @return string
     */
    public function getController(): string;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return string[]
     */
    public function getMethods(): array;
}
