<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DiscountCodeResource
 *
 * @OA\Schema(
 *     schema="DiscountCode",
 *
 *     @OA\Property(property="id", format="int64", type="integer"),
 *     @OA\Property(property="code", type="string"),
 *     @OA\Property(property="number_used", format="int64", type="integer")
 * )
 *
 * @OA\Schema(schema="DiscountCodes", type="array", @OA\Items(ref="#/components/schemas/DiscountCode"))
 *
 * @package App\Http\Resources
 *
 */
class DiscountCodeResource extends JsonResource
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
            'code' => $this->code,
            'number_used' => (string)$this->number_used,
        ];
    }
}
