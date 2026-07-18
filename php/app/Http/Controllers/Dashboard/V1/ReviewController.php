<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\ReviewRequest;
use App\Models\Review;
use App\Repositories\Contracts\ReviewContract;

class ReviewController extends BaseResourceController
{
    /**
     * ReviewController constructor.
     * @param ReviewContract $repository
     */
    public function __construct(ReviewContract $repository)
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

        //$reviewList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $reviewList = Review::orderByDesc('id')->get();

        if (request()->ajax()){
            return $this->loadPageAjax(['reviewList' => $reviewList]);
        }

        return $this->indexBlade(['reviewList' => $reviewList]);
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
     * @param ReviewRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReviewRequest $request)
    {
        //$this->repository->create($request->all());
        Review::create($request->all());

        alert()->success( __('Review added successfully'));
        return $this->redirectBack();
    }

     /**
     * Display the specified resource.
     *
     * @param Review $review
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Review $review)
    {
        return $this->showBlade(['review' => $review]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param Review $review
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Review $review)
    {
        return $this->editBlade(['review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReviewRequest $request
     * @param Review $review
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReviewRequest $request, Review $review)
    {
        //$this->repository->update($review, $request->all());
        $review->update($request->all());

        alert()->success( __('Review updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Review $review)
    {
        if ($review['related_data'] == 0) {
            //$this->repository->remove($review);
            $review->delete();
            return ajax_response(null, __('Review deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this review'), 400);
        }
    }
}
