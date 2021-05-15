<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountHistoryRequest;
use App\Http\Resources\DiscountHistoryResource;
use App\Models\DiscountCode;
use App\Models\DiscountHistory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DiscountHistoryController extends Controller
{
    /**
     * Use discount code.
     *
     * @OA\Post(
     *     path="/api/discount_histories/use_discount",
     *     tags={"DiscountHistories"},
     *     security={{"passport": {}}},
     *     operationId="DepositDiscountHistory",
     *     description="Deposit DiscountHistory.",
     * @OA\RequestBody(
     *         description="Its needed to create user and DiscountCode at first.",
     *         required=true,
     * @OA\MediaType(
     *         mediaType="application/x-www-form-urlencoded",
     * @OA\Schema(ref="#/components/schemas/DiscountHistoryRequest")
     *         )
     *     ),
     * @OA\Response(
     *         response=201,
     *         description="DiscountHistory response",
     * @OA\JsonContent(ref="#/components/schemas/DiscountHistory")
     *     )
     * )
     *
     * @param DiscountHistoryRequest $request Request.
     *
     * @return mixed
     */
    public function useDiscount(DiscountHistoryRequest $request)
    {
        $user = User::find($request->get('user_id'));
        $discountCode = DiscountCode::find($request->get('discount_code_id'));

        if ($discountCode->number_used >= DiscountHistory::usageLimit) {
            return $this->responseCodeIsNotValid();
        }

        if (DiscountHistory::usedDiscountCodeBefore($discountCode, $user)) {
            return $this->responseCodeUsedBefore();
        }

        return new DiscountHistoryResource(
            DiscountHistory::applyDiscountCode($discountCode, $user)
        );
    }

    /**
     * @return JsonResponse
     */
    public function responseCodeIsNotValid(): JsonResponse
    {
        return response()->json(
            [
                'message' => __('messages.discount_code_is_not_valid_or_expired')
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * @return JsonResponse
     */
    public function responseCodeUsedBefore(): JsonResponse
    {
        return response()->json(
            [
                'message' => __('messages.you_used_it_before')
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
