<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\ReactionRequest;
use App\Models\Reaction;
use App\Repositories\Contracts\ReactionContract;

class ReactionController extends BaseResourceController
{
    /**
     * ReactionController constructor.
     * @param ReactionContract $repository
     */
    public function __construct(ReactionContract $repository)
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

        //$reactionList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $reactionList = Reaction::orderByDesc('id')->get();

        if (request()->ajax()){
            return $this->loadPageAjax(['reactionList' => $reactionList]);
        }

        return $this->indexBlade(['reactionList' => $reactionList]);
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
     * @param ReactionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReactionRequest $request)
    {
        //$this->repository->create($request->all());
        Reaction::create($request->all());

        alert()->success( __('Reaction added successfully'));
        return $this->redirectBack();
    }

     /**
     * Display the specified resource.
     *
     * @param Reaction $reaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Reaction $reaction)
    {
        return $this->showBlade(['reaction' => $reaction]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param Reaction $reaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Reaction $reaction)
    {
        return $this->editBlade(['reaction' => $reaction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReactionRequest $request
     * @param Reaction $reaction
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReactionRequest $request, Reaction $reaction)
    {
        //$this->repository->update($reaction, $request->all());
        $reaction->update($request->all());

        alert()->success( __('Reaction updated successfully'));
        return $this->redirectBack();
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
        if ($reaction['related_data'] == 0) {
            //$this->repository->remove($reaction);
            $reaction->delete();
            return ajax_response(null, __('Reaction deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this reaction'), 400);
        }
    }
}
