<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\FavouriteRequest;
use App\Models\Favourite;
use App\Repositories\Contracts\FavouriteContract;

class FavouriteController extends BaseResourceController
{
    /**
     * FavouriteController constructor.
     * @param FavouriteContract $repository
     */
    public function __construct(FavouriteContract $repository)
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

        //$favouriteList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $favouriteList = Favourite::orderByDesc('id')->get();

        if (request()->ajax()){
            return $this->loadPageAjax(['favouriteList' => $favouriteList]);
        }

        return $this->indexBlade(['favouriteList' => $favouriteList]);
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
     * @param FavouriteRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FavouriteRequest $request)
    {
        //$this->repository->create($request->all());
        Favourite::create($request->all());

        alert()->success( __('Favourite added successfully'));
        return $this->redirectBack();
    }

     /**
     * Display the specified resource.
     *
     * @param Favourite $favourite
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Favourite $favourite)
    {
        return $this->showBlade(['favourite' => $favourite]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param Favourite $favourite
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Favourite $favourite)
    {
        return $this->editBlade(['favourite' => $favourite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FavouriteRequest $request
     * @param Favourite $favourite
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FavouriteRequest $request, Favourite $favourite)
    {
        //$this->repository->update($favourite, $request->all());
        $favourite->update($request->all());

        alert()->success( __('Favourite updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Favourite $favourite
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Favourite $favourite)
    {
        if ($favourite['related_data'] == 0) {
            //$this->repository->remove($favourite);
            $favourite->delete();
            return ajax_response(null, __('Favourite deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this favourite'), 400);
        }
    }
}
