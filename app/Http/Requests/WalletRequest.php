<?php

namespace App\Http\Requests;

class WalletRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @OA\Schema(
     *   schema="WalletRequest",
     *   type="object",
     *   required={
     *      "deposit",
     *      "user_id"
     * },
     * @OA\Property(property="deposit", type="int", description="How many you whant to apply"),
     * @OA\Property(property="user_id", type="int", description="Enter the selected user id")
     * )
     *
     * @return array
     */
    public function rules(): array
    {
        /*
         * User id should not be pass as parameter, Here is just a tech test.
         * */
        return [
            'deposit' => 'required|integer',
            'user_id' => [
                'required',
                'integer',
                sprintf('exists:%s,%s', 'users', 'id'),
            ]
        ];
    }
}
