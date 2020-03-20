<?php


namespace App\Domain\Comment\Repositories;


use App\Domain\Comment\Entities\Comment;
use App\Domain\_core\ReadRepository;
use Illuminate\Database\Eloquent\Builder;

class CommentRepository extends ReadRepository
{
    private $comments;

    public function __construct(Comment $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $message
     * @param null $query
     * @return Builder
     */
    public function search(int $id = null, string $name = null, string $email = null, string $message = null, $query = null): Builder
    {
        $query = $query ?? $this->comments->newQuery();

        if (isset($id))
            $query = $query->where('id', '=', $id);

        if (isset($name))
            $query = $query->where('name', 'LIKE', "%$name%");

        if (isset($email))
            $query = $query->where('email', 'LIKE', "%$email%");

        if (isset($message))
            $query = $query->where('message', 'LIKE', "%$message%");

        return $query;
    }
}
