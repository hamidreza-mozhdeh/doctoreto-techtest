<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of users resource.
     *
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     security={{"passport": {}}},
     *     operationId="GetAllUsers",
     *     description="Get All Users.",
     * @OA\Response(
     *         response=200,
     *         description="All users response",
     * @OA\JsonContent(ref="#/components/schemas/Users")
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a new User.
     *
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     security={{"passport": {}}},
     *     operationId="CreateUser",
     *     description="Create a new User.",
     * @OA\RequestBody(
     *         description="Just enter the mobile below",
     *         required=true,
     * @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     * @OA\Schema(ref="#/components/schemas/UserRequest")
     *         )
     *     ),
     * @OA\Response(
     *         response=201,
     *         description="User response",
     * @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     *
     * @param UserRequest $request Request.
     *
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {
        return new UserResource(
            User::createObject(
                $request->get('mobile')
            )
        );
    }

    /**
     * Display the user resource.
     *
     * @OA\Get(
     *     path="/api/users/{user_id}",
     *     tags={"Users"},
     *     security={{"passport": {}}},
     *     operationId="GetUser",
     *     description="Get User.",
     * @OA\Parameter(
     *         description="User id which is going to fetch",
     *         in="path",
     *         name="user_id",
     *         required=true,
     * @OA\Schema(type="integer",                        format="int64")
     *     ),
     * @OA\Response(
     *         response=200,
     *         description="Users response",
     * @OA\JsonContent(ref="#/components/schemas/Users")
     *     )
     * )
     *
     * @param User $user User.
     *
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
}
