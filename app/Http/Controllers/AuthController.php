<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    public static $validation_rules = [
        'register' => [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ],
        'login' => [
            'email' => 'required|max:64|email',
            'password' => 'required|min:3',
        ],
        'forgot_password' => [
            'email' => 'required|email|exists:users,email',
        ],
        'new_password' => [
            'password' => 'required|min:3',
        ],
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function signup(Request $request)
    {
        if (!$this->validateRequest($request->all(), self::$validation_rules['register'])) {
            return $this->responseError();
        }
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        try {
            $user->save();
        } catch (\Exception $e) {
            return $this->responseError();
        }
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function resetPasswordEmail(Request $request)
    {
        if (!$this->validateRequest($request->all(), self::$validation_rules['forgot_password'])) {
            return $this->responseError();
        }
        $user = User::where('email', $request->only('email'))->firstOrFail();

        $user->sendNewPasswordNotification($user->resetPassword());
        return Response::json($this->response);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function newPassword(Request $request)
    {

        if (!$this->validateRequest($request->all(), self::$validation_rules['new_password'])) {
            return $this->responseError();
        }

        $user = User::find(Auth::user()->id);
        $user->resetPassword($request->password);
        return Response::json($this->response);

    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
}
