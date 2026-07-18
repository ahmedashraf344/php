<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Api\V1\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\Competition;
use App\Models\Favourite;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use App\Models\UsersUuids;
use App\Repositories\Contracts\UserContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

   /**
    * UserController constructor.
    * @param UserContract $repository
    */
   /*public function __construct(UserContract $repository)
   {
        parent::__construct($repository, UserResource::class);
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
        $userList = User::orderByDesc('id')->get();

        return json_response([
           'userList'=>UserResource::collection($userList)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       //
    }


   /**
    * Display the specified resource.
    *
    * @param User $user
    *
    * @return \Illuminate\Http\JsonResponse|mixed
    */
   public function show(User $user)
   {
      return json_response([
          'user'=>new UserResource($user)
      ]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param User $user
    *
    * @return \Illuminate\Http\JsonResponse|mixed
    */
   public function edit(User $user)
   {
      return json_response([
          'user'=>new UserResource($user)
      ]);
   }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     *
     */
    public function update(UserRequest $request, User $user)
    {
        //
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
        //
    }


    public function deleteAccount(Request $request)
    {

        if(!$request->input('password') || !$request->has('password') || empty($request->input('password'))){
            return json_response(null , __("Please provide your password") , 400);
        }
        $currentUser = Auth::user();
        // echo 'current user id = '.$currentUser->id;
        // exit;
        if(!Hash::check($request->input('password') , $currentUser->password) ){
            return json_response(null, __("Wrong Password, Please try again"), 401);
        }
        Comment::where('user_id' , $currentUser->id)->delete();
        Competition::where('user_id' , $currentUser->id)->update(['user_id' => null]);
        DB::table('competitions_users')->where('user_id', $currentUser->id)->delete();
        Favourite::where('user_id' , $currentUser->id)->delete();
        DB::table('model_has_roles')->where('model_id' , $currentUser->id)->where('model_type' , 'App\Models\User')->delete();
        Notification::where('user_id' , $currentUser->id)->delete();
        Post::where('user_id' , $currentUser->id)->delete();
        Reaction::where('user_id' , $currentUser->id)->delete();
        Review::where('user_id' , $currentUser->id)->delete();
        Shop::where('user_id' , $currentUser->id)->update(['user_id' => null , 'status' => 2 , 'status_reason' => 'User Account Related To This Shop Deleted']);
        UsersUuids::where('user_id' , $currentUser->id)->delete();
        Auth::logout();
        User::where('id' , $currentUser->id)->delete();
        return json_response(null, __("Deleted Account and Logged out"), 200);

    }

}
