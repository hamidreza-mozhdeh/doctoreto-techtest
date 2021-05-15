<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DiscountHistoryResource
 *
 * @OA\Schema(
 *     schema="DiscountHistory",
 *
 * @OA\Property(property="id",               format="int64", type="integer"),
 * @OA\Property(property="discount_code_id", format="int64", type="integer"),
 * @OA\Property(property="user_id",          format="int64", type="integer"),
 * @OA\Property(property="discount_code",    ref="#/components/schemas/DiscountCode"),
 * @OA\Property(property="user",             ref="#/components/schemas/User"),
 * )
 *
 * @OA\Schema(schema="DiscountHistories", type="array", @OA\Items(ref="#/components/schemas/DiscountHistory"))
 *
 * @package App\Http\Resources
 */
class DiscountHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request BaseRequest.
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'discount_code' => new DiscountCodeResource($this->discountCode),
            'user' => new UserResource($this->user),
            'id' => $this->id,
            'user_id' => $this->user_id,
            'discount_code_id' => $this->discount_code_id,
        ];
    }
}
