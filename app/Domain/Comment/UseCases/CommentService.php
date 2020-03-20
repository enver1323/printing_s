<?php


namespace App\Domain\Comment\UseCases;


use App\Domain\Comment\Entities\Comment;
use App\Domain\Comment\Repositories\CommentRepository;
use App\Domain\_core\Service;
use App\Http\Requests\Admin\Comment\CommentSearchRequest;

/**
 * Class CommentService
 * @package App\Domain\Comment\UseCases
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property Comment $comments
 * @property CommentRepository $commentRepository
 */
class CommentService extends Service
{
    private $comments;
    private $commentRepository;

    public function __construct(Comment $comments, CommentRepository $commentRepository)
    {
        $this->comments = $comments;
        $this->commentRepository = $commentRepository;
    }

    public function search(CommentSearchRequest $request)
    {
        return $this->commentRepository->search($request->id, $request->name, $request->email, $request->message);
    }
}
