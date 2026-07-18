<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ShopRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShopResource;
use App\Models\Category;
use App\Models\Shop;
use App\Repositories\Contracts\ShopContract;
use App\Traits\FileTrait;
use App\Traits\ShopTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    use FileTrait, ShopTrait;

    /**
     * ShopController constructor.
     * @param ShopContract $repository
     */
    /*public function __construct(ShopContract $repository)
    {
         parent::__construct($repository, ShopResource::class);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        
        if(!Category::where('id' , request()['category_id'])->exists()){
            return json_response(null , __('Category does not exist') , 404);
        }
        
        $shopList = Shop::where('status', 1)->with(['existsInFavourite', 'reviews']);

        $mergeCollection=false;

        if (request()['category_id']) $shopList = $shopList->whereCategoryId(request()['category_id']);

        if (request()['keyword']) {
            $shopList = $shopList->where('name_ar', 'like', '%' . request()['keyword'] . '%')
                ->orWhere('name_en', 'like', '%' . request()['keyword'] . '%');
        }

        if (request()['order_by'] && in_array(request()['order_by'], Shop::SHOP_FILTERS)) {
            if (request()['order_by'] == 'rate_desc') {
                $shopList->select('shops.*')
                ->leftjoin('reviews', 'reviews.shop_id', '=', 'shops.id')
                ->where(function ($query) {
                    $query->whereDoesntHave('reviews')->orWhere('reviews.uuid_status', 1); })
                ->groupBy('shops.id')
                ->orderByRaw('sum(reviews.rate) desc');
            }
            if ((request()['order_by'] == 'nearest') && request('latitude') && request('longitude')) {
                $shopList = $shopList->whereNotNull('latitude')->whereNotNull('longitude')->select(DB::raw('*, ( 3959  * acos( cos( radians(' . request('latitude') . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . request('longitude') . ') ) + sin( radians(' . request('latitude') . ') ) * sin( radians( latitude ) ) ) ) AS distance'))
                // ->having('distance', '<', 10000)
                ->orderBy('distance');
                $mergeCollection=true;
            }
        }else{
            $shopList=$shopList->orderByDesc('id');
        }

        $category = Category::find(request()['category_id']) ?? null;
        $shopList = $shopList->paginate(10);

        
        return json_response([
            'category' => new CategoryResource($category),
            'shopList' => ShopResource::collection($shopList),
            'pagination' => paginate_response($shopList),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ShopRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        $request['status'] = Shop::STATUS_IN_REVIEW;
        $request['user_id'] = auth()->id();
        $shop = Shop::create($request->except('feature_image'));
        $featureImage = $this->saveFile($request['feature_image'], 'shops/' . $shop->id);
        $shop->update(['feature_image' => $featureImage]);

        $this->saveMoreImages($request, $shop);

        return json_response([
            'shop' => (new ShopResource($shop))->returnData('full')
        ], __('shop added successfully and waiting administration review, we will contact you soon'));
    }


    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show($shopID)
    {
        if (!Shop::where('id', $shopID)->exists()) {
            return json_response(null, __('Shop does not exist'), 404);
        }
        $shop = Shop::find($shopID);
        if ( !auth()->check() || auth()->id() != $shop['user_id']) $shop->update(['views' => $shop['views'] + 1]);

        return json_response([
            'shop' => (new ShopResource($shop))->returnData('full')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shop $shop
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Shop $shop)
    {
        return json_response([
            'shop' => new ShopResource($shop)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ShopRequest $request
     * @param Shop $shop
     *
     */
    public function update(ShopRequest $request, Shop $shop)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
