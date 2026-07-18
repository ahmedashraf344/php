<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Repositories\Contracts\ReviewContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    /**
     * ReviewController constructor.
     * @param ReviewContract $repository
     */
    /*public function __construct(ReviewContract $repository)
    {
         parent::__construct($repository, ReviewResource::class);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        //$filters = [];

        //$reviewList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $reviewList = Review::where('uuid_status' , 1)->whereShopId(request()['shop_id'])->orderByDesc('id')->paginate(10);

        return json_response([
            'reviewList' => ReviewResource::collection($reviewList),
            'pagination' => paginate_response($reviewList),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ReviewRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReviewRequest $request)
    {
        $user = Auth::user();
        if(!DB::table('users_uuids')->where('user_id' , $user->id)->exists()){
            return json_response(null , __('Sorry, Reviews are disabled'));
        }
        $updateData = [];
        $message = null;

        if ($request['rate']) {
            $updateData['rate'] = $request['rate'];
            $message = __('your rate added successfully');
        }
        if ($request['comment']) {
            $updateData['comment'] = $request['comment'];
            $message = __('your review added successfully');
        }

        Review::updateOrCreate([
            'user_id' => auth()->id(),
            'shop_id' => $request['shop_id']
        ], $updateData);

        $reviewList = Review::whereShopId($request['shop_id'])->orderByDesc('id')->paginate(10);

        return json_response([
            'reviewList' => ReviewResource::collection($reviewList),
            'pagination' => paginate_response($reviewList),
        ], $message);
    }


    /**
     * Display the specified resource.
     *
     * @param Review $review
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Review $review)
    {
        if($review->uuid_status != 1){
            return json_response(null , __('Sorry, Review not found') , 404);
        }
        return json_response([
            'review' => new ReviewResource($review)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Review $review
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Review $review)
    {
        return json_response([
            'review' => new ReviewResource($review)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ReviewRequest $request
     * @param Review $review
     *
     */
    public function update(ReviewRequest $request, Review $review)
    {
        //
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
        //
    }
}
