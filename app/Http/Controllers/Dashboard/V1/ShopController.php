<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\ShopRequest;
use App\Models\Category;
use App\Models\FileCenter;
use App\Models\Shop;
use App\Repositories\Contracts\ShopContract;
use App\Traits\FileTrait;
use App\Traits\ShopTrait;

class ShopController extends BaseResourceController
{
    use FileTrait, ShopTrait;

    /**
     * ShopController constructor.
     * @param ShopContract $repository
     */
    public function __construct(ShopContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.shops', 'dashboard.v1.shops', 'shop');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$shopList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $shopList = Shop::with(['category', 'reviews'])
            ->orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['shopList' => $shopList]);
        }

        return $this->indexBlade(['shopList' => $shopList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categoryList = Category::orderByDesc('id')->get()->pluck('name', 'id')->toArray();

        return $this->createBlade(['categoryList' => $categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShopRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShopRequest $request)
    {
        //$this->repository->create($request->all());
        $shop = Shop::create($request->except('feature_image'));
        $featureImage = $this->saveFile($request['feature_image'], 'shops/' . $shop->id);
        $shop->update(['feature_image' => $featureImage]);

        $this->saveMoreImages($request, $shop);

        alert()->success(__('Shop added successfully'));
        return $this->redirectBack();
    }

    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Shop $shop)
    {
        $shop = $shop->load('reviews', 'category');
        $averageRate = $shop->reviews->avg('rate') ?? 0;
        $reviewsCount = $shop->reviews->whereNotNull('comment')->count();
        $reviewsList = $shop->reviews()->whereNotNull('comment')->paginate(20);
        $commentsList = $shop->comments()->paginate(20);

        return $this->showBlade([
            'shop' => $shop, 'averageRate' => $averageRate,
            'reviewsCount' => $reviewsCount, 'reviewsList' => $reviewsList, 'commentsList' => $commentsList
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shop $shop
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Shop $shop)
    {
        $categoryList = Category::orderByDesc('id')->get()->pluck('name', 'id')->toArray();

        return $this->editBlade(['shop' => $shop, 'categoryList' => $categoryList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShopRequest $request
     * @param Shop $shop
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ShopRequest $request, Shop $shop)
    {
        //$this->repository->update($shop, $request->all());
        $shop->update($request->except('feature_image'));

        if ($request->hasFile('feature_image')) {
            $this->deleteFile($shop['feature_image']);

            $featureImage = $this->saveFile($request['feature_image'], 'shops/' . $shop->id);
            $shop->update(['feature_image' => $featureImage]);
        }

//        dd($request->all());
        $this->saveMoreImages($request, $shop);

        alert()->success(__('Shop updated successfully'));
        return $this->redirectBack();
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
        if ($shop['related_data'] == 0) {
            //$this->repository->remove($shop);
            $shop->delete();
            return ajax_response(null, __('Shop deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this shop'), 400);
        }
    }
}
