<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Comment\UseCases\CommentService;
use App\Http\Requests\Admin\Comment\CommentSearchRequest;
use Illuminate\View\View;

/**
 * Class CommentController
 * @package App\Http\Controllers\Admin
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property CommentService $commentService
 */
class CommentController extends AdminController
{
    private $commentService;

    public function __construct(CommentService $service)
    {
        $this->commentService = $service;
    }

    public function index(CommentSearchRequest $request): View
    {
        $comments = $this->commentService->search($request)->orderByDesc('id')->paginate(self::ITEMS_PER_PAGE);

        return $this->render('comments.commentIndex', [
            'comments' => $comments
        ]);
    }
}
