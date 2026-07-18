<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Api\V1\ReactionRequest;
use App\Http\Resources\ReactionResource;
use App\Models\Reaction;
use App\Repositories\Contracts\ReactionContract;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Database\Eloquent\Model;

class ReactionController extends BaseController
{

    /**
     * ReactionController constructor.
     * @param ReactionContract $repository
     */
    /*public function __construct(ReactionContract $repository)
    {
         parent::__construct($repository, ReactionResource::class);
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
        $reactionList = Reaction::orderByDesc('id')->get();

        return json_response([
            'reactionList' => ReactionResource::collection($reactionList)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ReactionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ReactionRequest $request)
    {
        $reactionQuery = Reaction::whereUserId(auth()->id())->where('model_id', $request['model_id'])
            ->where('model_type', $request['model_type']);

        if ($reactionQuery->exists()) {
            $oldReaction = $reactionQuery->first();
            if (!$request['status']) {
                $request['status'] = ($oldReaction['status'] < 2) ? ($oldReaction['status'] + 1) : Reaction::STATUS_NONE;
            }
        }
        $reaction = Reaction::updateOrCreate([
            'user_id' => auth()->id(),
            'model_type' => $request['model_type'],
            'model_id' => $request['model_id'],
        ], [
            'status' => $request['status'] ?? Reaction::STATUS_LIKE,
        ]);

        return json_response([
            'reaction' => (new ReactionResource($reaction))->returnData('basic')
        ], __('item reaction is') . ' ' . status_value($reaction) . ' ' . __('successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param Reaction $reaction
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Reaction $reaction)
    {
        return json_response([
            'reaction' => new ReactionResource($reaction)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reaction $reaction
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Reaction $reaction)
    {
        return json_response([
            'reaction' => new ReactionResource($reaction)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ReactionRequest $request
     * @param Reaction $reaction
     *
     */
    public function update(ReactionRequest $request, Reaction $reaction)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Reaction $reaction
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Reaction $reaction)
    {
        //
    }
}
