<?php declare(strict_types=1);

namespace App\Controller\Blog;

use Sklkv22\Http\Exception as HttpException;
use Sklkv22\Http\Protocol\ServerMessageInterface;
use Sklkv22\Http\ServerMessage;

final class PostController extends AbstractController
{
    public function __invoke(int $id): ServerMessageInterface
    {
        $post = $this->repository->getById($id);
        if (null === $post) {
            throw new HttpException('Post Not Found', 404);
        }

        return new ServerMessage(
            theme(
                'post.php',
                [
                    'post' => $post,
                ]
            )
        );
    }
}
