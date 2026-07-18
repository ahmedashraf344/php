<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Role;
use App\Repositories\Contracts\PostContract;
use App\Traits\FileTrait;

class PostController extends Controller
{
    use FileTrait;

    /**
     * PostController constructor.
     * @param PostContract $repository
     */
    /*public function __construct(PostContract $repository)
    {
         parent::__construct($repository, PostResource::class);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        //$filters = [];

        //$userList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $postList = Post::whereStatus(Post::STATUS_PUBLISHED);
        if (request()['order_desc'] == true) $postList = $postList->orderByDesc('id');
        $postList = $postList->paginate(10);
        return json_response([
            'postList' => PostResource::collection($postList),
            'pagination' => paginate_response($postList),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        if (!auth()->user()->hasRole(Role::ROLE_SUPER_ADMIN)) {
            $request['user_id'] = auth()->id();
            $message = __('post added successfully and waiting administration review, we will contact you soon');
        } else {
            $request['status'] = Post::STATUS_PUBLISHED;
            $message = __('post added successfully');
        }
        $post = Post::create($request->except('image'));
        $image = $this->saveFile($request['image'], 'posts/' . $post->id);
        $post->update(['image' => $image]);

        return json_response([
            'post' => (new PostResource($post))->returnData('full')
        ], $message);
    }


    /**
     * Display the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Post $post)
    {
        if (auth()->id() != $post['user_id']) $post->update(['views' => $post['views'] + 1]);

        return json_response([
            'post' => (new PostResource($post))->returnData('full')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Post $post)
    {
        return json_response([
            'post' => new PostResource($post)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     *
     */
    public function update(PostRequest $request, Post $post)
    {
        //
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
        //
    }
}
