<?php

declare(strict_types=1);

namespace App\Base\Storage;

use PDO;
use PDOException;

final class SqliteConnection implements ConnectionInterface
{
    private PDO $connection;

    /**
     * @throws PDOException
     */
    public function __construct(
        string $databasePath
    ) {
        $this->connection = new PDO($databasePath);
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
