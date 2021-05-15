<?php

namespace App\Http\Requests;

class DiscountHistoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @OA\Schema(
     *   schema="DiscountHistoryRequest",
     *   type="object",
     *   required={
     *      "discount_code_id",
     *      "user_id"
     * },
     * @OA\Property(property="discount_code_id", type="int", description="DiscountCode id"),
     * @OA\Property(property="user_id",          type="int", description="User id")
     * )
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discount_code_id' => [
                'required',
                'integer',
                sprintf('exists:%s,%s', 'discount_codes', 'id'),
            ],
            'user_id' => [
                'required',
                'integer',
                sprintf('exists:%s,%s', 'users', 'id'),
            ]
        ];
    }
}
