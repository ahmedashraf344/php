<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\FileCenterRequest;
use App\Models\Attachment;
use App\Models\FileCenter;
use App\Repositories\Contracts\FileCenterContract;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class FileCenterController extends BaseResourceController
{
    use FileTrait;

    /**
     * FileCenterController constructor.
     * @param FileCenterContract $repository
     */
    public function __construct(FileCenterContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.file-center', 'dashboard.v1.file-center','filecenter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$fileCenterList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $fileCenterList = FileCenter::orderByDesc('id')->get();

        if (request()->ajax()){
            return $this->loadPageAjax(['fileCenterList' => $fileCenterList]);
        }

        return $this->indexBlade(['fileCenterList' => $fileCenterList]);
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
     * @param FileCenterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileCenterRequest $request)
    {
        //$this->repository->create($request->all());
        FileCenter::create($request->all());

        alert()->success( __('FileCenter added successfully'));
        return $this->redirectBack();
    }

     /**
     * Display the specified resource.
     *
     * @param FileCenter $fileCenter
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(FileCenter $fileCenter)
    {
        return $this->showBlade(['fileCenter' => $fileCenter]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param FileCenter $fileCenter
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(FileCenter $fileCenter)
    {
        return $this->editBlade(['fileCenter' => $fileCenter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FileCenterRequest $request
     * @param FileCenter $fileCenter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FileCenterRequest $request, FileCenter $fileCenter)
    {
        //$this->repository->update($fileCenter, $request->all());
        $fileCenter->update($request->all());

        alert()->success( __('FileCenter updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FileCenter $file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FileCenter $file)
    {
        if ($file['related_data'] == 0) {
            //$this->repository->remove($file);
            $file->delete();
            return ajax_response(null, __('File deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this file'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $path
     * @param Model $updatedObject
     * @param string $modelName
     * @param null $updatedColumn
     *
     * @return JsonResponse
     */
    public function destroyByPath($path, $updatedObject, $modelName, $updatedColumn)
    {
        $modelClass = "App\\Models\\{$modelName}";
        $updatedObject = (new $modelClass)->find($updatedObject);

        $path = base64_decode($path);
        $attachment = FileCenter::where('file', $path)->first();
        if ($attachment != null) return $this->destroy($attachment);

        if (!Storage::exists($this->replaceStorageFolder($path))) {
            return ajax_response(null, __('Missing file can not be deleted'), 400);
        }

        if ($this->deleteFile($path)) {
            $updatedObject->update([$updatedColumn => null]);
            return ajax_response(null, __('Attachment deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this attachment'), 400);
        }
    }
}
