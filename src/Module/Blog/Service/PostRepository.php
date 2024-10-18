<?php declare(strict_types=1);

namespace App\Module\Blog\Service;

final class PostRepository
{
    private array $posts = [
        ['id' => 33, 'title' => 'Coding Day!', 'summary' => 'Hello guys... Welcome to my blog.'],
        ['id' => 154, 'title' => 'Hello world', 'summary' => 'Get started with PHP'],
        ['id' => 99, 'title' => 'Output files', 'summary' => 'Let\'s find different funcs.'],
        ['id' => 73, 'title' => 'Hackers', 'summary' => 'Insert two lines for security your PC'],
        ['id' => 834, 'title' => 'Cool spring', 'summary' => 'Very nice day. I want to eat and I want to...'],
        ['id' => 1024, 'title' => 'Cool winter', 'summary' => 'Some text...'],
        ['id' => 2048, 'title' => 'Last post', 'summary' => 'Good bye!'],
    ];
    
    private ?int $count = null;
    
    /**
     * @return list<Post>
     */
    public function getList(int $limit = 3, int $offset = 1): array
    {
        return array_map(
            static function (array $post): Post {
                $entity = new Post();
                $entity->id = $post['id'];
                $entity->title = $post['title'];
                $entity->summary = $post['summary'];
                return $entity;
            },
            array_slice($this->posts, ($limit * ($offset - 1)), $limit)
        );
    }
    
    public function getCount(): int
    {
        if (null === $this->count) {
            $this->count = count($this->posts);
        }
        
        return $this->count;
    }
    
    public function getById(int $id): ?Post
    {
        foreach ($this->posts as $post) {
            if ($id === $post['id']) {
                $entity = new Post();
                $entity->id = $post['id'];
                $entity->title = $post['title'];
                $entity->summary = $post['summary'];
                return $entity;
            }
        }
        
        return null;
    }
}
