<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\PostRequest;
use App\Models\Post;
use App\Repositories\Contracts\PostContract;
use App\Traits\FileTrait;

class PostController extends BaseResourceController
{
    use FileTrait;

    /**
     * PostController constructor.
     * @param PostContract $repository
     */
    public function __construct(PostContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.posts', 'dashboard.v1.posts','posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$postList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $postList = Post::orderByDesc('id')->get();

        if (request()->ajax()){
            return $this->loadPageAjax(['postList' => $postList]);
        }

        return $this->indexBlade(['postList' => $postList]);
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
     * @param PostRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        //$this->repository->create($request->all());

        $request['status'] = Post::STATUS_PUBLISHED;
        $post = Post::create($request->except('image'));
        $image = $this->saveFile($request['image'], 'posts/' . $post->id);
        $post->update(['image' => $image]);

        alert()->success( __('Post added successfully'));
        return $this->redirectBack();
    }

     /**
     * Display the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return $this->showBlade(['post' => $post]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return $this->editBlade(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        //$this->repository->update($post, $request->all());
        $requests=$request->except('image');
        if ($request['image']) {
            $this->deleteFile($post['image']);
            $requests['image'] = $this->saveFile($request['image'], 'posts/' . $post->id);
        }

        $post->update($requests);

        alert()->success( __('Post updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        if ($post['related_data'] == 0) {
            //$this->repository->remove($post);
            $post->delete();
            return ajax_response(null, __('Post deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this post'), 400);
        }
    }
}
