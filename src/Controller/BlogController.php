<?php declare(strict_types=1);

namespace App\Controller;

use App\Cms\Controller\AbstractController;
use App\Common\Http\HttpException;
use App\Common\Http\Protocol\ServerMessageInterface;
use App\Service\Blog\PostRepository;

final class BlogController extends AbstractController
{
    public function __construct(
        private PostRepository $repository
    ) {
    }
    
    /**
     * @throws HttpException
     */
    public function home(): ServerMessageInterface
    {
        return $this->render(
            __DIR__ . '/../../view/home.php',
            [
                'posts' => $this->repository->getList(),
            ]
        );
    }
    
    public function post(int $id): ServerMessageInterface
    {
        $post = $this->repository->getById($id);
        if (null === $post) {
            throw new HttpException('Post Not Found', 404);
        }
        
        return $this->render(
            __DIR__ . '/../../view/post.php',
            [
                'post' => $post,
            ]
        );
    }
}
