<?php declare(strict_types=1);

namespace App\Module\User\Service;

final class UserRepository
{
    public function getList(): array
    {
        return [
            ['id' => 1, 'name' => 'Noone', 'age' => 30],
            ['id' => 2, 'name' => 'Someone', 'age' => 24],
            ['id' => 3, 'name' => 'Anyone', 'age' => 54],
        ];
    }
}
