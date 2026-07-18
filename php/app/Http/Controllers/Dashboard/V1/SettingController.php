<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\SettingRequest;
use App\Models\Setting;
use App\Repositories\Contracts\SettingContract;
use App\Traits\FileTrait;

class SettingController extends BaseResourceController
{
    use FileTrait;

    /**
     * SettingController constructor.
     * @param SettingContract $repository
     */
    public function __construct(SettingContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.settings', 'dashboard.v1.settings', 'setting');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$settingList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $settingList = Setting::orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['settingList' => $settingList]);
        }

        return $this->indexBlade(['settingList' => $settingList]);
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
     * @param SettingRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SettingRequest $request)
    {
        foreach ($request->except('group_title', 'logo') as $key => $value) {
            Setting::where('group_title', $request['group_title'])
                ->where('key', $key)->update(['value' => $value]);
        }
        if ($request->hasFile('logo')) {
            $logo = Setting::where('group_title', $request['group_title'])
                ->where('key', 'logo')->first();
            $this->deleteFile($logo['value']);

            $path = $this->saveFile($request['logo'], 'settings/logo');
            $logo->update(['value' => $path]);
        }
        alert()->success(__('changes saved successfully'));
        return $this->redirectToShow($request['group_title']);
    }

    /**
     * Display the specified resource.
     *
     * @param string $groupTitle
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $groupTitle)
    {
        $page = 'general-settings';
        if ($groupTitle == 'about_page') $page = 'about-us';
        if ($groupTitle == 'terms_page') $page = 'terms';
        return $this->customBlade($page, ['groupTitle' => $groupTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Setting $setting)
    {
        return $this->editBlade(['setting' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @param string $groupTitle
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingRequest $request, string $groupTitle)
    {
        foreach ($request->except('group_title', 'logo') as $key => $value) {
            Setting::where('group_title', $request['group_title'])
                ->where('key', $key)->update(['value' => $value]);
        }
        if ($request->hasFile('logo')) {
            $logo = Setting::where('group_title', $request['group_title'])
                ->where('key', 'logo')->first();
            $this->deleteFile($logo['value']);

            $path = $this->saveFile($request['logo'], 'settings/logo');
            $logo->update(['value' => $path]);
        }

        alert()->success(__('changes saved successfully'));
        return $this->redirectBack();
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
        if ($setting['related_data'] == 0) {
            //$this->repository->remove($setting);
            $setting->delete();
            return ajax_response(null, __('Setting deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this setting'), 400);
        }
    }
}
