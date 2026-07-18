<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\CategoryRequest;
use App\Models\Category;
use App\Repositories\Contracts\CategoryContract;
use App\Traits\FileTrait;

class CategoryController extends BaseResourceController
{
    use FileTrait;

    /**
     * CategoryController constructor.
     * @param CategoryContract $repository
     */
    public function __construct(CategoryContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.categories', 'dashboard.v1.categories', 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$categoryList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $categoryList = Category::withCount('subcategories')
            ->whereNull('category_id')->orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['categoryList' => $categoryList]);
        }

        return $this->indexBlade(['categoryList' => $categoryList]);
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
     * @param CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        //$this->repository->create($request->all());
        $category = Category::create($request->except('feature_image'));
        $featureImage = $this->saveFile($request['feature_image'], 'categories/' . $category->id);
        $category->update(['feature_image' => $featureImage]);

        alert()->success( __('Category added successfully'));
        return $this->redirectBack();
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $categoryList = Category::whereCategoryId($category['id'])
            ->withCount('subcategories')
            ->orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['currentCategory' => $category ,'categoryList' => $categoryList]);
        }

        return $this->showBlade(['currentCategory' => $category, 'categoryList' => $categoryList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categoryList = Category::orderByDesc('id')->get()->pluck('name', 'id')->toArray();
        return $this->editBlade(['category' => $category, 'categoryList' => $categoryList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $requests = $request->except('feature_image');
        if ($request['feature_image']) {
            $this->deleteFile($category['feature_image']);
            $featureImage = $this->saveFile($request['feature_image'], 'categories/' . $category->id);
            $requests['feature_image'] = $featureImage;
        }

        //$this->repository->update($category,$requests);
        $category->update($requests);

        alert()->success( __('Category updated successfully'));
        return $this->redirectBack();
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
        if ($category['related_data'] == 0) {
            //$this->repository->remove($category);
            $category->delete();
            return ajax_response(null, __('Category deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this category'), 400);
        }
    }
}
