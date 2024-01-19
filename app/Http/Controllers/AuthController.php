<?php

namespace App\Http\Controllers;

use App\APiService\ApiResponse;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        return $this->success([
            'user' => $user->register($request),
            'token' => $user->createToken('mohammad')->accessToken
        ],
            ResponseStatus::HTTP_CREATED,
            'User successfully created');
    }
}
