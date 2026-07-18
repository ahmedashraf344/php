<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Requests\Api\V1\UserRequest;
use App\Http\Resources\UserResource;
use App\Mail\Api\ForgetPasswordMail;
use App\Mail\Api\LoginWithoutVerifyMail;
use App\Mail\Api\RegisterMail;
use App\Mail\Api\ResendCodeMail;
use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use function PHPSTORM_META\map;

class AuthController extends Controller
{
    use FileTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $exceptFunctions = ['login', 'register', 'activateAccount', 'resendCode', 'forgetPassword',
            'checkForgetPasswordCode', 'resetPassword'];

        $this->middleware('auth:api', ['except' => $exceptFunctions]);
        $this->middleware('jwt', ['except' => $exceptFunctions]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'password' => 'required',
            'device_id' => 'required|string',
            'device_token' => 'nullable'
        ], [], [
            'identity' => __('identity'),
            'password' => __('password'),
            'device_id' => __('Device ID'),
            'device_token' => __('Device Token')
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $identity = $request->input('identity');
        $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $request->merge([$fieldName => $identity]);
        $credentials = $request->only($fieldName, 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return json_response(null, __('validation errors'),
                    422, ['identity' => collect(__('incorrect identity or password'))]);
            }
        } catch (JWTException $e) {
            return json_response(null, null,
                500, ['exception' => collect(__('could not create token'))]);
        }

        $user = auth()->user();

        // if($user['verification_status'] != 1){
        //     $code = User::generateCode();

        //     $user->update(['code' => $code]);

        //     if ($user['email']) Mail::to($user['email'])->send(new LoginWithoutVerifyMail($user['name'], $user['code']));
        //     auth()->logout();
        //     return json_response(null, __('Your account is not verified yet, We sent you verification code , please verify it first to login'), 401);
        // }
        
        if($request->input('device_token') != null) $user->device_token = $request->input('device_token');
        $user->save();

        // if ($request->input('device_id') != null) {
        $newDeviceId = $request->input('device_id');

        if (DB::table('users_uuids')->where('user_id', $user->id)->where('device_id' , '<>' , $newDeviceId)->exists()) {
            DB::table('users_uuids')->where('user_id', $user->id)->where('device_id', '<>', $newDeviceId)->update([
                'user_id' => 0
            ]);
        }

        if(DB::table('users_uuids')->where('device_id', $newDeviceId)->exists()){
            $newUserUUIDRow = DB::table('users_uuids')->where('device_id', $newDeviceId)->first();
            $deviceOldUserId = $newUserUUIDRow->user_id;
            Comment::where('user_id' , $deviceOldUserId)->update(['uuid_status' => 0]);
            Review::where('user_id', $deviceOldUserId)->update(['uuid_status' => 0]);

            DB::table('users_uuids')->where('device_id', $newDeviceId)->update([
                'user_id' => $user->id
            ]);
        }
        if(!DB::table('users_uuids')->where('device_id' , $newDeviceId)->where('user_id' , $user->id)->exists()){
            DB::table('users_uuids')->insert([
                'user_id' => $user->id,
                'device_id' => $newDeviceId
            ]);
        }
        // }
        Comment::where('user_id', $user->id)->update(['uuid_status' => 1]);
        Review::where('user_id', $user->id)->update(['uuid_status' => 1]);

        $token = JWTAuth::fromUser(auth()->user());
        JWTAuth::setToken($token);

        return $this->respondWithToken($token, __('login successfully'));
    }


    public function register(UserRequest $request)
    {
        // $request['code'] = User::generateCode();
        $newDeviceId = $request->input('device_id');

        $user = User::create($request->all());
        $user->verification_status = 1;
        $user->save();

        if (DB::table('users_uuids')->where('device_id', $newDeviceId)->exists()) {
            $newUserUUIDRow = DB::table('users_uuids')->where('device_id', $newDeviceId)->first();
            $deviceOldUserId = $newUserUUIDRow->user_id;
            Comment::where('user_id', $deviceOldUserId)->update(['uuid_status' => 0]);
            Review::where('user_id', $deviceOldUserId)->update(['uuid_status' => 0]);

            DB::table('users_uuids')->where('device_id', $newDeviceId)->update([
                'user_id' => $user->id
            ]);
        }

        if (!DB::table('users_uuids')->where('device_id', $newDeviceId)->exists()) {
            DB::table('users_uuids')->insert([
                'user_id' => $user->id,
                'device_id' => $newDeviceId
            ]);
        }

        // if ($request['email']) Mail::to($user['email'])->send(new RegisterMail($user['name'], $user['code']));

        $token = JWTAuth::fromUser($user);
        JWTAuth::setToken($token);

        return $this->respondWithToken($token, __('account created, you are now logged in.'));
    }


    public function activateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'nullable|required_without:email|numeric|digits:11|exists:users,mobile',
            'email' => 'nullable|required_without:mobile|email|max:180|exists:users,email',
            'code' => 'required|digits:4|exists:users,code',
        ], [], [
            'mobile' => __('mobile'),
            'email' => __('email'),
            'code' => __('activation code')
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $user = User::whereCode($request['code']);
        if ($request['mobile']) $user = $user->whereMobile($request['mobile'])->first();
        if ($request['email']) $user = $user->whereEmail($request['email'])->first();
        if ($user) {
            $user->update(['code' => null, 'verification_status' => User::VERIFICATION_STATUS_DONE]);
            $user->fresh();
            return json_response([
                'user_data' => (new UserResource($user))->returnData('basic')
            ], __('account activated successfully'));
        }
        return json_response(null, __('validation errors'), 422, ['code' => [__('code does not match to email / mobile')]]);

    }


    private function generateCode(Request $request)
    {
        if ($request['mobile']) $user = User::whereMobile($request['mobile'])->first();
        if ($request['email']) $user = User::whereEmail($request['email'])->first();

        $code=User::generateCode();
        
        return $user->update(['code' => $code]);
    }

    private function generateForgetPassCode(Request $request){
        if ($request['mobile']) $user = User::whereMobile($request['mobile'])->first();
        if ($request['email']) $user = User::whereEmail($request['email'])->first();

        $code=User::generateCode();

        if ($request['email']) Mail::to($user['email'])->send(new ForgetPasswordMail($user['name'],$code));

        return $user->update(['forget_code' => $code]);
    }


    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'nullable|required_without:email|numeric|digits:11|exists:users,mobile',
            'email' => 'nullable|required_without:mobile|email|max:180|exists:users,email',
        ], [], [
            'mobile' => __('mobile'),
            'email' => __('email'),
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;
        if ($request['mobile']) $user = User::whereMobile($request['mobile'])->first();
        if ($request['email']) $user = User::whereEmail($request['email'])->first();

        $code = User::generateCode();

        $user->update(['code' => $code]);
        if ($request['email']) Mail::to($user['email'])->send(new ResendCodeMail($user['name'], $code));

        return json_response(null, __('code resent successfully'));
    }


    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'nullable|required_without:email|numeric|digits:11|exists:users,mobile',
            'email' => 'nullable|required_without:mobile|email|max:180|exists:users,email',
        ], [], [
            'mobile' => __('mobile'),
            'email' => __('email'),
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;


        $this->generateForgetPassCode($request);

        return json_response(null, __('reset password code sent successfully'));
    }


    public function checkForgetPasswordCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'nullable|required_without:email|numeric|digits:11|exists:users,mobile',
            'email' => 'nullable|required_without:mobile|email|max:180|exists:users,email',
            'code' => 'required|digits:4|exists:users,forget_code',
        ], [], [
            'mobile' => __('mobile'),
            'email' => __('email'),
            'code' => __('activation code')
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $user = User::whereForgetCode($request['code']);
        if ($request['mobile']) $user = $user->whereMobile($request['mobile'])->first();
        if ($request['email']) $user = $user->whereEmail($request['email'])->first();
        if ($user) {

            $user->update(['forget_code' => null]);
            $user->fresh();
            return json_response([
                'user_data' => (new UserResource($user))->returnData('mini')
            ], __('forget password code exists, please redirect to reset password page'));
        }
        return json_response(null, __('validation errors'), 422, ['code' => [__('code does not match to email / mobile')]]);

    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'password' => 'required|min:6|max:100|different:current_password',
            'password_confirmation' => 'required|same:password',
        ], [], [
            'user_id' => __('user id'),
            'password' => __('new password'),
            'password_confirmation' => __('new password confirmation'),
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $user=User::find($request['user_id']);
        $user->password = $request['password'];
        $user->update();

        auth()->login($user);
        $token = JWTAuth::fromUser($user);
        JWTAuth::setToken($token);

        return $this->respondWithToken($token, __('password reset successfully'));
    }


    public function updateProfile(UpdateUserRequest $request)
    {

        $user = JWTAuth::parseToken()->authenticate();
        $user->update($request->only('name', 'email', 'mobile'));
        if ($request['avatar']) {
            $this->deleteFile($user['avatar']);
            $avatar = $this->saveFile($request['avatar'], 'users/' . $user->id);
            $user->update(['avatar' => $avatar]);
        }

        return json_response([
            'user_data' => (new UserResource($user))->returnData('basic')
        ], __('profile data updated successfully'));
    }


    public function changePassword(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:100|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ], [], [
            'current_password' => __('current password'),
            'new_password' => __('new password'),
            'new_password_confirmation' => __('new password confirmation'),
        ]);

        if ($request['current_password'] != null && !Hash::check($request['current_password'], $user->password)) {
            return json_response(null, __('validation errors'),
                422, ['current_password' => collect(__('incorrect current password'))]);
        }

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $request['password'] = $request['new_password'];
        $user->password = $request['password'];
        $user->update();
        return json_response(null, __('password changed successfully'));

    }


    public function updateDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'nullable',
            'device_id' => 'nullable',
        ], [], [
            'device_token' => __('device token'),
            'device_id' => __('device id')
        ]);

        $validationResponse = $this->checkValidationErrors($validator);
        if ($validationResponse) return $validationResponse;

        $user = JWTAuth::parseToken()->authenticate();
        $user->device_token = $request['device_token'];
        $user->device_id = $request['device_id'];
        $user->update();

        return json_response([
            'user_data' => (new UserResource($user))->returnData('basic')
        ], __('device token updated successfully'));
    }


    private function checkValidationErrors($validator)
    {
        if ($validator->fails()) {
            return json_response(null, __('validation errors'), 422, $validator->errors());
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return json_response([
            'user_data' => (new UserResource($user))->returnData('basic')
        ]);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        // JWTAuth::invalidate(JWTAuth::getToken());
        return json_response(null, __('logged out successfully'));
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(), __('token refreshed successfully'));
    }


    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param null $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $message = null)
    {
        $user = JWTAuth::toUser($token);
        return json_response([
            'token_type' => 'bearer',
            'access_token' => $token,
            'user_data' => (new UserResource($user))->returnData('basic')
        ], $message);
    }
}
