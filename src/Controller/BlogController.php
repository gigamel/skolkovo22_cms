<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Http\HttpException;
use App\Common\Http\Protocol\ServerMessageInterface;
use App\Common\Http\ServerMessage;
use App\Service\Blog\PostRepository;

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
