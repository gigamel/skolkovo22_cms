<?php

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
