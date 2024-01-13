<?php

namespace App\Http\Controllers;

use App\APiService\ApiResponse;
use App\Http\Resources\UserResource;
use App\LogService\LogService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;


class UserController extends Controller
{
    use ApiResponse, LogService;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->success(UserResource::collection(User::all()->load('posts')), ResponseStatus::HTTP_OK, ResponseStatus::$statusTexts[200]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return $this->success(new UserResource($user->load('posts')), ResponseStatus::HTTP_OK, ResponseStatus::$statusTexts[200]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
