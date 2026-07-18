<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\CommentRequest;
use App\Models\Comment;
use App\Repositories\Contracts\CommentContract;

class CommentController extends BaseResourceController
{
    /**
     * CommentController constructor.
     * @param CommentContract $repository
     */
    public function __construct(CommentContract $repository)
    {
        parent::__construct($repository, 'routeNameValue', 'viewPathValue','permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$commentList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $commentList = Comment::orderByDesc('id')->get();

        if (request()->ajax()){
            return $this->loadPageAjax(['commentList' => $commentList]);
        }

        return $this->indexBlade(['commentList' => $commentList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return $this->createBlade();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        //$this->repository->create($request->all());
        Comment::create($request->all());

        alert()->success( __('Comment added successfully'));
        return $this->redirectBack();
    }

     /**
     * Display the specified resource.
     *
     * @param Comment $comment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Comment $comment)
    {
        return $this->showBlade(['comment' => $comment]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        return $this->editBlade(['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        //$this->repository->update($comment, $request->all());
        $comment->update($request->all());

        alert()->success( __('Comment updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        if ($comment['related_data'] == 0) {
            //$this->repository->remove($comment);
            $comment->delete();
            return ajax_response(null, __('Comment deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this comment'), 400);
        }
    }
}
