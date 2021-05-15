<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountCodeRequest;
use App\Http\Resources\DiscountCodeResource;
use App\Models\DiscountCode;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of discount code.
     *
     * @OA\Get(
     *     path="/api/discount_codes",
     *     tags={"DiscountCodes"},
     *     security={{"passport": {}}},
     *     operationId="GetAllDiscountCodes",
     *     description="Get All DiscountCodes.",
     * @OA\Response(
     *         response=200,
     *         description="All Discount Codes response",
     * @OA\JsonContent(ref="#/components/schemas/DiscountCodes")
     *     )
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return DiscountCodeResource::collection(DiscountCode::all());
    }

    /**
     * Store a new Discount Code.
     *
     * @OA\Post(
     *     path="/api/discount_codes",
     *     tags={"DiscountCodes"},
     *     security={{"passport": {}}},
     *     operationId="CreateDiscountCode",
     *     description="Create a new DiscountCode.",
     * @OA\RequestBody(
     *         description="Code to add",
     *         required=true,
     * @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     * @OA\Schema(ref="#/components/schemas/DiscountCodeRequest")
     *         )
     *     ),
     * @OA\Response(
     *         response=201,
     *         description="Discount response",
     * @OA\JsonContent(ref="#/components/schemas/DiscountCode")
     *     )
     * )
     *
     * @param DiscountCodeRequest $request Request.
     *
     * @return DiscountCodeResource
     */
    public function store(DiscountCodeRequest $request): DiscountCodeResource
    {
        return new DiscountCodeResource(
            DiscountCode::createObject(
                $request->get('code')
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/api/discount_codes/{discount_code_id}",
     *     tags={"DiscountCodes"},
     *     security={{"passport": {}}},
     *     operationId="GetDiscountCode",
     *     description="Get DiscountCode.",
     * @OA\Parameter(
     *         description="DiscountCode id which is going to fetch",
     *         in="path",
     *         name="discount_code_id",
     *         required=true,
     * @OA\Schema(type="integer",                                format="int64")
     *     ),
     * @OA\Response(
     *         response=200,
     *         description="DiscountCodes response",
     * @OA\JsonContent(ref="#/components/schemas/DiscountCodes")
     *     )
     * )
     *
     * @param DiscountCode $discount_code DiscountCode.
     *
     * @return DiscountCodeResource
     */
    public function show(DiscountCode $discount_code): DiscountCodeResource
    {
        return new DiscountCodeResource($discount_code);
    }
}
