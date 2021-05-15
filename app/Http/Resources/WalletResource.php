<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class WalletResource
 *
 * @OA\Schema(
 *     schema="Wallet",
 *
 * @OA\Property(property="id",       format="int64", type="integer"),
 * @OA\Property(property="user_id",  format="int64", type="integer"),
 * @OA\Property(property="deposit",  format="int64", type="integer"),
 * @OA\Property(property="withdraw", format="int64", type="integer"),
 * @OA\Property(property="balance",  format="int64", type="integer"),
 * @OA\Property(property="user",     ref="#/components/schemas/User"),
 * )
 *
 * @OA\Schema(schema="Wallets", type="array", @OA\Items(ref="#/components/schemas/Wallet"))
 *
 * @package App\Http\Resources
 */
class WalletResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'id' => $this->id,
            'user_id' => $this->user_id,
            'deposit' => $this->deposit,
            'withdraw' => $this->withdraw,
            'balance' => $this->balance,
        ];
    }
}
