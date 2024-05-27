<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Framework\Storage\ConnectionInterface;
use PDO;

class UserRepository
{
    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(private ConnectionInterface $connection)
    {
    }
    
    /**
     * @return User[]
     */
    public function getList(int $limit = 20, int $offset = 0): array
    {
        return $this->connection
            ->getConnection()
            ->query(sprintf('SELECT * FROM `user` LIMIT %d OFFSET %d;', $limit, $offset))
            ->fetchAll(PDO::FETCH_CLASS, User::class);
    }
    
    /**
     * @param int $id
     *
     * @return User|null
     */
    public function getById(int $id): ?User
    {
        return $this->connection
            ->getConnection()
            ->query(sprintf('SELECT * FROM `user` WHERE `id`= %d;', $id))
            ->fetchObject(User::class) ?: null;
    }
}
