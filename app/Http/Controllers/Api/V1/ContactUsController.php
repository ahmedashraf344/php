<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ContactUsRequest;
use App\Http\Resources\ContactUsResource;
use App\Models\ContactUs;
use App\Repositories\Contracts\ContactUsContract;

class ContactUsController extends Controller
{

   /**
    * ContactUsController constructor.
    * @param ContactUsContract $repository
    */
   /*public function __construct(ContactUsContract $repository)
   {
        parent::__construct($repository, ContactUsResource::class);
   }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        //$filters = [];

        //$contactUsList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $contactUsList = ContactUs::orderByDesc('id')->get();

        return json_response([
           'contactUsList'=>ContactUsResource::collection($contactUsList)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ContactUsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
       ContactUs::create($request->all());

       return json_response(null,__('your message sent to administration successfully'));
    }


   /**
    * Display the specified resource.
    *
    * @param ContactUs $contactUs
    *
    * @return \Illuminate\Http\JsonResponse|mixed
    */
   public function show(ContactUs $contactUs)
   {
      return json_response([
          'contactUs'=>new ContactUsResource($contactUs)
      ]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param ContactUs $contactUs
    *
    * @return \Illuminate\Http\JsonResponse|mixed
    */
   public function edit(ContactUs $contactUs)
   {
      return json_response([
          'contactUs'=>new ContactUsResource($contactUs)
      ]);
   }


    /**
     * Update the specified resource in storage.
     *
     * @param ContactUsRequest $request
     * @param ContactUs $contactUs
     *
     */
    public function update(ContactUsRequest $request, ContactUs $contactUs)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param ContactUs $contactUs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
