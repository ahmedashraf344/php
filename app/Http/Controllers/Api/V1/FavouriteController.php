<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\FavouriteRequest;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\ShopResource;
use App\Models\Favourite;
use App\Models\Shop;
use App\Repositories\Contracts\FavouriteContract;

class FavouriteController extends Controller
{

    /**
     * FavouriteController constructor.
     * @param FavouriteContract $repository
     */
    /*public function __construct(FavouriteContract $repository)
    {
         parent::__construct($repository, FavouriteResource::class);
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

        $favouriteList = Shop::has('existsInFavourite');
        if (request()['keyword']) {
            $favouriteList = $favouriteList->where(function ($q) {
                $q->where('name_ar', 'like', '%' . request()['keyword'] . '%')
                    ->orWhere('name_en', 'like', '%' . request()['keyword'] . '%');
            });
        }
        $favouriteList = $favouriteList->paginate(10);

        return json_response([
            'favouriteList' => ShopResource::collection($favouriteList),
            'pagination' => paginate_response($favouriteList),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param FavouriteRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FavouriteRequest $request)
    {
        $shop = Favourite::whereUserId(auth()->id())->where('shop_id', $request['shop_id'])->first();
        if ($shop) {
            $shop->delete();
            $message = __('shop removed from favourites successfully');
        } else {
            Favourite::create([
                'user_id' => auth()->id(),
                'shop_id' => $request['shop_id']
            ]);
            $message = __('shop added to favourites successfully');
        }

        $favouriteShops = auth()->user()->favourite->pluck('shop_id');
        $favouriteList = Shop::whereIn('id', $favouriteShops)->paginate(10);

        return json_response([
            'favouriteList' => ShopResource::collection($favouriteList),
            'pagination' => paginate_response($favouriteList),
        ], $message);
    }


    /**
     * Display the specified resource.
     *
     * @param Favourite $favourite
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Favourite $favourite)
    {
        return json_response([
            'favourite' => new FavouriteResource($favourite)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Favourite $favourite
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Favourite $favourite)
    {
        return json_response([
            'favourite' => new FavouriteResource($favourite)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param FavouriteRequest $request
     * @param Favourite $favourite
     *
     */
    public function update(FavouriteRequest $request, Favourite $favourite)
    {
        //
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
        //
    }
}
