<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AnnouncementRequest;
use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use App\Repositories\Contracts\AnnouncementContract;

class AnnouncementController extends Controller
{

    /**
     * AnnouncementController constructor.
     * @param AnnouncementContract $repository
     */
    /*public function __construct(AnnouncementContract $repository)
    {
         parent::__construct($repository, AnnouncementResource::class);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        //$filters = [];

        //$announcementList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $announcementList = Announcement::enabledAnnouncements()->orderByDesc('id')->paginate(30);

        return json_response([
            'announcementList' => AnnouncementResource::collection($announcementList),
            'pagination' => paginate_response($announcementList),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AnnouncementRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param Announcement $announcement
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Announcement $announcement)
    {

        return json_response([
            'announcement' => new AnnouncementResource($announcement)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Announcement $announcement
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Announcement $announcement)
    {
        return json_response([
            'announcement' => new AnnouncementResource($announcement)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AnnouncementRequest $request
     * @param Announcement $announcement
     *
     */
    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Announcement $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
