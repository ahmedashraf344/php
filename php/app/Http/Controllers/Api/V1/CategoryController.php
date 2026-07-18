<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShopResource;
use App\Models\Category;
use App\Repositories\Contracts\CategoryContract;

class CategoryController extends Controller
{

    /**
     * CategoryController constructor.
     * @param CategoryContract $repository
     */
    /*public function __construct(CategoryContract $repository)
    {
         parent::__construct($repository, CategoryResource::class);
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

        $categoryList = Category::whereNull('category_id');

        if (request()['keyword']) {
            $categoryList = $categoryList->where('name_ar', 'like', '%' . request()['keyword'] . '%')
                ->orWhere('name_en', 'like', '%' . request()['keyword'] . '%');
        }

        if (request()['order_desc'] == true) $categoryList = $categoryList->orderByDesc('id');

        $categoryList = $categoryList->paginate(30);

        return json_response([
            'categoryList' => CategoryResource::collection($categoryList),
            'pagination' => paginate_response($categoryList),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Category $category)
    {
        $category->update(['views' => $category['views'] + 1]);

        $categoryList = Category::whereCategoryId($category['id']);

        if (request()['keyword']) {
            $categoryList = $categoryList->where('name_ar', 'like', '%' . request()['keyword'] . '%')
                ->orWhere('name_en', 'like', '%' . request()['keyword'] . '%');
        }

        if (request()['order_desc'] == true) $categoryList = $categoryList->orderByDesc('id');

        $categoryList = $categoryList->paginate(30);

        return json_response([
            'parentCategory' => new CategoryResource($category),
            'categoryList' => CategoryResource::collection($categoryList),
//            'shopList' => ShopResource::collection($category->shops),
            'pagination' => paginate_response($categoryList),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectCategoryList()
    {
        $selectCategoryList = Category::orderByDesc('id')->get()->pluck('name', 'id')->toArray();

        return json_response([
            'selectCategoryList' => $selectCategoryList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Category $category)
    {
        return json_response([
            'category' => new CategoryResource($category)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     *
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        //
    }
}
