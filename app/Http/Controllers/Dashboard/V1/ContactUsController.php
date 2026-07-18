<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\ContactUsRequest;
use App\Models\ContactUs;
use App\Repositories\Contracts\ContactUsContract;

class ContactUsController extends BaseResourceController
{
    /**
     * ContactUsController constructor.
     * @param ContactUsContract $repository
     */
    public function __construct(ContactUsContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.contact-us-forms', 'dashboard.v1.contact-us-forms', 'contactus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$contactUsFormList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $contactUsFormList = ContactUs::orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['contactUsList' => $contactUsFormList]);
        }

        return $this->indexBlade(['contactUsList' => $contactUsFormList]);
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
     * @param ContactUsRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactUsRequest $request)
    {
        //$this->repository->create($request->all());
        ContactUs::create($request->all());

        alert()->success(__('ContactUs added successfully'));
        return $this->redirectBack();
    }

    /**
     * Display the specified resource.
     *
     * @param ContactUs $contactUsForm
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ContactUs $contactUsForm)
    {
        return $this->showBlade(['contactUs' => $contactUsForm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ContactUs $contactUsForm
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ContactUs $contactUsForm)
    {
        $contactUsForm->update(['status' => ContactUs::STATUS_CONTACTED]);

        alert()->success(__('contact form status marked as contacted successfully'));
        return $this->redirectToIndex();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactUsRequest $request
     * @param ContactUs $contactUsForm
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactUsRequest $request, ContactUs $contactUsForm)
    {
        //$this->repository->update($contactUsForm, $request->all());
        $contactUsForm->update($request->all());

        alert()->success(__('ContactUs updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactUs $contactUsForm
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ContactUs $contactUsForm)
    {
        if ($contactUsForm['related_data'] == 0) {
            //$this->repository->remove($contactUsForm);
            $contactUsForm->delete();
            return ajax_response(null, __('Contact us form deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this contact us form'), 400);
        }
    }
}
