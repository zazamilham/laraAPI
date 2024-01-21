<?php

namespace App\Http\Controllers;

use App\APiService\ApiResponse;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;


class AuthController extends Authenticate
{
    use ApiResponse;

    public function register(AuthRegisterRequest $request, User $user): JsonResponse
    {
//        $validate = \Validator::make($request->all(), [
//            'name' => 'required|string',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required',
//            'c_password' => 'required|same:password'
//        ]);
//
//        if ($validate->fails()) {
//            return $this->error($validate->messages(),
//                ResponseStatus::HTTP_UNPROCESSABLE_ENTITY,
//                ResponseStatus::$statusTexts[422]);
//        }

//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => bcrypt($request->password)
//        ]);
//
//        $user->save();

        $usrRegister = $user->register($request);
        $token = $usrRegister->createToken('mohammad')->accessToken;
        return $this->success([
            'user' => $usrRegister,
            'token' => $token
        ],
            ResponseStatus::HTTP_CREATED,
            'User register successfully ');
    }

    public function login(AuthLoginRequest $request, User $user): JsonResponse
    {
//        $validate = \Validator::make($request->all(), [
//            'email' => 'required|email|exists:users,email',
//            'password' => 'required'
//        ]);
//        if ($validate->fails()) {
//            return $this->error(null, ResponseStatus::HTTP_UNPROCESSABLE_ENTITY, $validate->messages());
//        }

        if (!$usrLogin = $user->login($request)) {
            return $this->error(null, ResponseStatus::HTTP_UNPROCESSABLE_ENTITY, 'password is incorrect');
        }
        $token = $usrLogin->createToken('mohammad')->accessToken;
        return $this->success([
            'user' => $usrLogin,
            'token' => $token
        ],
            ResponseStatus::HTTP_OK,
            'User login successfully'
        );
    }

    public function logout(): JsonResponse
    {
        auth()->user()->token()->delete();

        return $this->success(null,
            ResponseStatus::HTTP_OK,
            'User logout Successfully');
    }
}
