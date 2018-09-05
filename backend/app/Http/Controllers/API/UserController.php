<?php
/**
 * Created by PhpStorm.
 * User: zachariasz
 * Date: 2018-08-19
 * Time: 22:03
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Helpers\Status;
use App\Http\Models\User;
use App\Notifications\SignupActivate;
use App\Providers\AuthServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,Hash,Validator
};

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */
class UserController extends Controller{

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request){
        //validate some passwords
        $this->validate($request,[
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['is_active'] = 1;
        $credentials['deleted_at'] = NULL;
        if(Auth::attempt($credentials)){
            $user = $request->user();
            $tokenResult = $user->createToken(AuthServiceProvider::TOKEN_NAME);
            $token = $tokenResult->token;
            //expires time
            $token->expires_at = $request->remember_me ?
                Carbon::now()->addWeeks(AuthServiceProvider::EXPIRE_TOKENS_WITH_REMEMBER_ME_IN_DAYS) :
                Carbon::now()->addDay(AuthServiceProvider::EXPIRE_TOKENS_IN_DAYS);

            $token->save();
            $success = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => AuthServiceProvider::TOKEN_TYPE,
                'expires_at' => Carbon::parse(
                    $token->expires_at
                )->toDateTimeString()
            ];

            return response()->json(['success' => $success],Status::SUCCESS_OK);
        }else{
            return response()->json(['error' => __('messages.unauthorized')],Status::ERROR_UNAUTHORIZED);
        }
    }

    /**
     * register Api
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if($validator->fails())         return response()->json(['error' => $validator->errors(), Status::ERROR_UNAUTHORIZED]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password'],[
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
        //set activation token
        $user = new User([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'activation_token' => str_random(60)
        ]);
        $user->notify(new SignupActivate($user));
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success],Status::SUCCESS_OK);
    }

    /**
     * here we are activation user or unactive it
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(string $token){
        $user = User::where('activation_token',$token)->first();
        if(!$user){
            return response()->json(['message' => __('messages.token_wrong')],Status::ERROR_UNAUTHORIZED);
        }

        $user->is_active = TRUE;
        $user->activation_token = '';
        $user->save();

        return response()->json(['message' => __('messages.user_activated'),'user' => $user],Status::SUCCESS_OK);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function details(){
        $user = Auth::user();
        return response()->json(['success' => $user],Status::SUCCESS_OK);
    }


}