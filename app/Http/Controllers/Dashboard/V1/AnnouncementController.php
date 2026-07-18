<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\AnnouncementRequest;
use App\Models\Announcement;
use App\Repositories\Contracts\AnnouncementContract;
use App\Traits\FileTrait;

class AnnouncementController extends BaseResourceController
{
    use FileTrait;

    /**
     * AnnouncementController constructor.
     * @param AnnouncementContract $repository
     */
    public function __construct(AnnouncementContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.announcements', 'dashboard.v1.announcements', 'announcement');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$announcementList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $announcementList = Announcement::orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['announcementList' => $announcementList]);
        }

        return $this->indexBlade(['announcementList' => $announcementList]);
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
     * @param AnnouncementRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AnnouncementRequest $request)
    {
        //$this->repository->create($request->all());
        $announcement = Announcement::create($request->except('feature_image'));
        $featureImage = $this->saveFile($request['feature_image'], 'announcements/' . $announcement->id);
        $announcement->update(['feature_image' => $featureImage]);

        alert()->success(__('Announcement added successfully'));
        return $this->redirectBack();
    }

    /**
     * Display the specified resource.
     *
     * @param Announcement $announcement
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Announcement $announcement)
    {
        return $this->showBlade(['announcement' => $announcement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Announcement $announcement
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Announcement $announcement)
    {
        return $this->editBlade(['announcement' => $announcement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AnnouncementRequest $request
     * @param Announcement $announcement
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        //$this->repository->update($announcement, $request->all());

        $requests = $request->except('feature_image');
        if ($request['feature_image']) {
            $this->deleteFile($announcement['feature_image']);
            $featureImage = $this->saveFile($request['feature_image'], 'announcements/' . $announcement->id);
            $requests['feature_image'] = $featureImage;
        }
        if($requests['enable_at'] == ''){
            $requests['enable_at'] = null;
        }
        if($requests['disable_at'] == ''){
            $requests['disable_at'] = null;
        }
        $announcement->update($requests);

        alert()->success(__('Announcement updated successfully'));
        return $this->redirectBack();
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
        if ($announcement['related_data'] == 0) {
            //$this->repository->remove($announcement);
            $announcement->delete();
            return ajax_response(null, __('Announcement deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this announcement'), 400);
        }
    }
}
