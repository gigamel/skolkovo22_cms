<?php declare(strict_types=1);

namespace App\Cms\DI;

use App\Common\DI\ContainerInterface as FrameworkContainerInterface;

interface ContainerInterface extends FrameworkContainerInterface
{
    public function importArguments(string $source): void;
}
