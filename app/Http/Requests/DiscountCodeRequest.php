<?php

namespace App\Http\Requests;

class DiscountCodeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @OA\Schema(
     *   schema="DiscountCodeRequest",
     *   type="object",
     *   required={
     *      "code"
     * },
     * @OA\Property(property="code", type="string"),
     * )
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|string|min:4|max:6'
        ];
    }
}
