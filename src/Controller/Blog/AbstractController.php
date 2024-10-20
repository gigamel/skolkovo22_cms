<?php declare(strict_types=1);

namespace App\Controller\Blog;

use App\Module\Blog\Service\PostRepository;

abstract class AbstractController
{
    public function __construct(
        protected PostRepository $repository
    ) {
    }
}
