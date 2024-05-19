<?php

declare(strict_types=1);

namespace App\Framework\Storage;

use PDO;
use PDOException;

interface ConnectionInterface
{
    /**
     * @return PDO
     *
     * @throws PDOException
     */
    public function getConnection(): PDO;
}
