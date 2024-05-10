<?php

declare(strict_types=1);

namespace App\Common;

use Throwable;

final class Application
{
    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $this->processApplication();
        } catch (Throwable $e) {
            $this->processThrowable($e);
        }
    }
    
    /**
     * @return void
     *
     * @throws Throwable
     */
    private function processApplication(): void
    {
        echo 'Hello from App! <a href="/admin/">Admin panel</a>';
    }
    
    /**
     * @param Throwable $e
     *
     * @return void
     */
    private function processThrowable(Throwable $e): void
    {
        echo sprintf('<pre style="border:1px solid green;padding: 15px;background-color: #ddd;">%s</pre>', $e->getTraceAsString());
    }
}
