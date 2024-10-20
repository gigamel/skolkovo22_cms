<?php declare(strict_types=1);

namespace App\Controller\Blog;

use Sklkv22\Http\Exception as HttpException;
use Sklkv22\Http\Protocol\ServerMessageInterface;
use Sklkv22\Http\ServerMessage;

final class PostsController extends AbstractController
{
    public function __invoke(int $page = 1): ServerMessageInterface
    {
        $posts = $this->repository->getList(3, $page);
        if (!$posts) {
            return new ServerMessage('Posts Not Found', 404);
        }

        return new ServerMessage(
            theme(
                'posts.php',
                [
                    'posts' => $posts,
                    'all' => $this->repository->getCount(),
                    'limit' => 3,
                    'page' => $page,
                ]
            )
        );
    }
}
