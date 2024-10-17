<?php declare(strict_types=1);

namespace App\Controller;

use App\Module\Blog\Service\PostRepository;
use Skolkovo22\Http\HttpException;
use Skolkovo22\Http\Protocol\ServerMessageInterface;
use Skolkovo22\Http\ServerMessage;

final class BlogController
{
    public function __construct(
        private PostRepository $repository
    ) {
    }
    
    /**
     * @throws HttpException
     */
    public function posts(int $page = 1): ServerMessageInterface
    {
        return new ServerMessage(
            render(
                'posts.php',
                [
                    'posts' => $this->repository->getList(),
                    'all' => $this->repository->getCount(),
                    'limit' => 3,
                    'page' => $page,
                ]
            )
        );
    }
    
    public function post(int $id): ServerMessageInterface
    {
        $post = $this->repository->getById($id);
        if (null === $post) {
            throw new HttpException('Post Not Found', 404);
        }
        
        return new ServerMessage(
            render(
                'post.php',
                [
                    'post' => $post,
                ]
            )
        );
    }
}
