<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Api\V1\UserRequest;
use App\Models\User;
use App\Repositories\Contracts\UserContract;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Log;

class UserController extends BaseResourceController
{
    use FileTrait;

    /**
     * UserController constructor.
     * @param UserContract $repository
     */
    public function __construct(UserContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.users', 'dashboard.v1.users', 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$filters = [];

        //$userList = $this->repository->search($filters, [], true, true, 10, 'id', 'desc');
        $userList = User::with('uuid')->orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['userList' => $userList]);
        }

        return $this->indexBlade(['userList' => $userList]);
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
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        //$this->repository->create($request->all());
        User::create($request->all());

        alert()->success(__('User added successfully'));
        return $this->redirectBack();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return $this->showBlade(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return $this->editBlade(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        //$this->repository->update($user, $request->all());

        $requests=$request->except('avatar');
        if ($request['avatar']){
            $this->deleteFile($user['avatar']);
            $requests['avatar'] = $this->saveFile($request['avatar'], 'users/' . $user->id);
        }
        if(!$requests['password'] || empty(trim($requests['password']))){
            unset($requests['password']);
            unset($requests['password_confirmation']);
        }
        $user->update($requests);

        alert()->success(__('User updated successfully'));
        return $this->redirectBack();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        if (($user['related_data'] == 0) && !in_array($user['id'], User::MAIN_ACCOUNTS_IDS)) {
            //$this->repository->remove($user);
            $user->delete();
            return ajax_response(null, __('User deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this user'), 400);
        }
    }
}
