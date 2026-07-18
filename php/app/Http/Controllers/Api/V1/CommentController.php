<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Role;
use App\Models\Shop;
use App\Repositories\Contracts\CommentContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    /**
     * CommentController constructor.
     * @param CommentContract $repository
     */
    /*public function __construct(CommentContract $repository)
    {
         parent::__construct($repository, CommentResource::class);
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

        $modelTable = request()['model_type'] ? table_of_model_name(request()->get('model_type')) : '';
        $modelIdRule = request()['model_type'] ? 'exists:' . $modelTable . ',id' : '';
        $validator = Validator::make(request()->all(), [
            'model_type' => 'required|in:' . array_to_string(Comment::MODEL_TYPE),
            'model_id' => 'required|' . $modelIdRule,
        ], [
            'model_type.in' => __('item id must be value of these values') . ' ' . array_to_string(Comment::MODEL_TYPE),
            'model_id.exists' => __('item id must exists in table of') . ' ' . $modelTable,
        ], [
            'model_id' => __('item id'),
            'model_type' => __('item type'),
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $model = request()['model_type']::find(request()['model_id']);
        if ($model == null) return json_response_error(404);
        $commentList = collect([]);
        if ($model) {
            $commentList = $model->publishedComments();
            if (request()['order_desc'] == true) $commentList = $model->publishedCommentsOrderedDesc();
        }
        $commentList = $commentList->paginate(10);

        return json_response([
            'commentList' => CommentResource::collection($commentList),
            'pagination' => paginate_response($commentList),
        ]);
    }

    private function checkValidationErrors($validator)
    {
        if ($validator->fails()) {
            return json_response(null, __('validation errors'), 422, $validator->errors());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $user = Auth::user();
        if (!DB::table('users_uuids')->where('user_id', $user->id)->exists()) {
            return json_response(null, __('Sorry, Comments are disabled'));
        }
        $message = __('comment added successfully');
        $request['status'] = Comment::STATUS_PUBLISHED;
        if (!auth()->user()->hasRole(Role::ROLE_SUPER_ADMIN)) {
            $request['user_id'] = auth()->id();
            //$message = __('comment added successfully and waiting administration review, we will contact you soon');
        }
        if($request['model_type'] == 'App\Models\Shop' && !Shop::where('id' , $request['model_id'])->exists()){
            return json_response(null, __('Shop does not exit'), 422); 
        }
        $comment = Comment::create($request->all());

        $comment->model->update(['comments' => $comment->model['comments'] + 1]);

        return json_response([
            'comment' => (new CommentResource($comment))->returnData('basic')
        ], $message);
    }


    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Comment $comment)
    {
        if ($comment->uuid_status != 1) {
            return json_response(null, __('Sorry, Comment not found'), 404);
        }
        return json_response([
            'comment' => new CommentResource($comment)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Comment $comment)
    {
        return json_response([
            'comment' => new CommentResource($comment)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     *
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        //
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
        $relatedModel = $comment->model;
        if ($comment->delete()) {
            $relatedModel->update(['comments' => $relatedModel['comments'] - 1]);

            return json_response(null, __('comment deleted successfully'));
        }
        return json_response(null, __('unknown error during deleting comment'), 500);
    }
}
