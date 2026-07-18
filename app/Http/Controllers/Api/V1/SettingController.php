<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SettingRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Repositories\Contracts\SettingContract;

class SettingController extends Controller
{

    /**
     * SettingController constructor.
     * @param SettingContract $repository
     */
    /*public function __construct(SettingContract $repository)
    {
         parent::__construct($repository, SettingResource::class);
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
        $settingList = Setting::orderByDesc('id')->get();

        return json_response([
            'settingList' => SettingResource::collection($settingList)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param string $groupTitle
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(string $groupTitle)
    {
        if ($groupTitle == 'about_page') {
            $titleKey = 'about_title_' . app()->getLocale();
            $contentKey = 'about_content_' . app()->getLocale();
            $title = setting_value($titleKey) != null ? setting_value($titleKey) : setting_value('about_title_ar');
            $content = setting_value($contentKey) != null ? setting_value($contentKey) : setting_value('about_content_ar');
            return json_response([
                'title' => $title,
                'content' => html_entity_decode($content),
            ]);
        }
        if ($groupTitle == 'terms_page') {
            $titleKey = 'terms_title_' . app()->getLocale();
            $contentKey = 'terms_content_' . app()->getLocale();
            $title = setting_value($titleKey) != null ? setting_value($titleKey) : setting_value('terms_title_ar');
            $content = setting_value($contentKey) != null ? setting_value($contentKey) : setting_value('terms_content_ar');
            return json_response([
                'title' => $title,
                'content' => html_entity_decode($content),
            ]);
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function edit(Setting $setting)
    {
        return json_response([
            'setting' => new SettingResource($setting)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @param Setting $setting
     *
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
