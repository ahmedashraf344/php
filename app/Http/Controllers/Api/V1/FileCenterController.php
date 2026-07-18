<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Api\V1\FileCenterRequest;
use App\Http\Resources\FileCenterResource;
use App\Models\FileCenter;
use App\Repositories\Contracts\FileCenterContract;

class FileCenterController extends BaseApiController
{

   /**
    * FileCenterController constructor.
    * @param FileCenterContract $repository
    */
   /*public function __construct(FileCenterContract $repository)
   {
        parent::__construct($repository, FileCenterResource::class);
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
        $fileCenterList = FileCenter::orderByDesc('id')->get();

        return json_response([
           'fileCenterList'=>FileCenterResource::collection($fileCenterList)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param FileCenterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FileCenterRequest $request)
    {
       //
    }


   /**
    * Display the specified resource.
    *
    * @param FileCenter $fileCenter
    *
    * @return \Illuminate\Http\JsonResponse|mixed
    */
   public function show(FileCenter $fileCenter)
   {
      return json_response([
          'fileCenter'=>new FileCenterResource($fileCenter)
      ]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param FileCenter $fileCenter
    *
    * @return \Illuminate\Http\JsonResponse|mixed
    */
   public function edit(FileCenter $fileCenter)
   {
      return json_response([
          'fileCenter'=>new FileCenterResource($fileCenter)
      ]);
   }


    /**
     * Update the specified resource in storage.
     *
     * @param FileCenterRequest $request
     * @param FileCenter $fileCenter
     *
     */
    public function update(FileCenterRequest $request, FileCenter $fileCenter)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param FileCenter $fileCenter
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FileCenter $fileCenter)
    {
        //
    }
}
