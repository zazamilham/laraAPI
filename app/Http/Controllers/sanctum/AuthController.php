<?php

namespace App\Http\Controllers\sanctum;

use App\APiService\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(AuthRegisterRequest $request, User $user): JsonResponse
    {

        $usrRegister = $user->register($request);
        $token = $usrRegister->createToken('myApp')->plainTextToken;
        return $this->success([
            'user' => $usrRegister,
            'token' => $token
        ],
            ResponseStatus::HTTP_CREATED,
            'User register successfully ');
    }

    public function login(AuthLoginRequest $request, User $user): JsonResponse
    {
        if (!$usrLogin = $user->login($request)) {
            return $this->error(null, ResponseStatus::HTTP_UNPROCESSABLE_ENTITY, 'password is incorrect');
        }
        $token = $usrLogin->createToken('mohammad')->plainTextToken;
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
        auth()->user()->tokens()->delete();

        return $this->success(null,
            ResponseStatus::HTTP_OK,
            'User logout Successfully');
    }

}
