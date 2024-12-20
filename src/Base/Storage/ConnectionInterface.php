<?php

declare(strict_types=1);

namespace App\Base\Storage;

use PDO;

interface ConnectionInterface
{
    public function getConnection(): PDO;
}
