<?php declare(strict_types=1);

namespace App\Service\Catalog;

final class ProductRepository
{
    private const array PRODUCTS = [
        1 => [
            'title' => 'Some product 1',
            'summary' => 'Hello from this product',
        ],
        2 => [
            'title' => 'Some product 2',
            'summary' => 'Hello from this product...',
        ],
    ];
    
    public function getById(int $id): ?array
    {
        return self::PRODUCTS[$id] ?? null;
    }
}
