<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 *
 * @OA\Schema(
 *     schema="User",
 *
 *     @OA\Property(property="id", format="int64", type="integer"),
 *     @OA\Property(property="mobile", type="string"),
 *     @OA\Property(property="name", type="string")
 * )
 *
 * @OA\Schema(schema="Users", type="array", @OA\Items(ref="#/components/schemas/User"))
 *
 * @package App\Http\Resources
 *
 */
class UserResource extends JsonResource
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
            'mobile' => $this->mobile,
            'name' => (string)$this->name,
        ];
    }
}
