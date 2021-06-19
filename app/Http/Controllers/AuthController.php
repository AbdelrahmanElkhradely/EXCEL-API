<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;

class AuthController extends Controller
{

    use GeneralTrait;
    /**
     * @SWG\Post(
     *   path="/api/admin/update_password",
     *   tags={"Admin"},
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Update password",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="password", type="string", example="abc123")),
     *      )
     * )
     *
     */
    public function login_admin(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];


            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            //return token
            return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
    /**
     * @SWG\Post(
     *   path="/api/admin/update_password",
     *   tags={"Admin"},
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Update password",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="password", type="string", example="abc123")),
     *      )
     * )
     *
     */
    public function admin_logout(Request $request)
    {
        $token = $request -> header('auth-token');
        if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','some thing went wrong');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        }else{
            $this -> returnError('','some thing went wrong');
        }

    }
    /**
     * @SWG\Post(
     *   path="/api/admin/update_password",
     *   tags={"Admin"},
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Update password",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="password", type="string", example="abc123")),
     *      )
     * )
     *
     */
    public function login_user(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];


            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('user-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $user = Auth::guard('user-api')->user();
            $user->api_token = $token;
            //return token
            return $this->returnData('user', $user);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }


}
