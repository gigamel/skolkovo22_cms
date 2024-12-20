<?php

declare(strict_types=1);

namespace App\Service\Complex;

use App\Base\Storage\ConnectionInterface;
use PDO;

final class ComplexRepository
{
    private ?int $count = null;

    private const array COMPLEXES = [
        ['id' => 1, 'title' => 'Complex #1', 'description' => 'Desc 1'],
        ['id' => 2, 'title' => 'Complex #2', 'description' => 'Desc 2'],
        ['id' => 3, 'title' => 'Complex #3', 'description' => 'Desc 3'],
        ['id' => 4, 'title' => 'Complex #4', 'description' => 'Desc 4'],
        ['id' => 5, 'title' => 'Complex #5', 'description' => 'Desc 5'],
        ['id' => 6, 'title' => 'Complex #6', 'description' => 'Desc 6'],
        ['id' => 7, 'title' => 'Complex #7', 'description' => 'Desc 7'],
    ];

    public function __construct(
        private ConnectionInterface $connection
    ) {
    }

    public function getCount(): int
    {
        if (null === $this->count) {
            $this->count = $this->connection->getConnection()
                ->query('SELECT COUNT(`id`) FROM `complex`;')
                ->fetchColumn();
        }

        return $this->count ?? 0;
    }

    public function save(Complex $complex): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE `complex` SET `title` = :title, `description` = :description WHERE `id` = :id;'
        );
        return $statement->execute([
            'title' => $complex->title,
            'description' => $complex->description,
            'id' => $complex->id,
        ]);
    }

    public function getById(int $id): ?Complex
    {
        return $this->connection->getConnection()
            ->query('SELECT * FROM `complex` WHERE `id` = '.$id.';')
            ->fetchObject(Complex::class) ?: null;
    }

    public function getList(int $limit = 3, int $offset = 1): array
    {
        return $this->connection->getConnection()
            ->query('SELECT * FROM `complex` LIMIT '.$limit.' OFFSET '.(($offset - 1) * $limit).';')
            ->fetchAll(PDO::FETCH_CLASS, Complex::class) ?: [];
    }
}
