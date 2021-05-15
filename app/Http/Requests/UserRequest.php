<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @OA\Schema(
     *   schema="UserRequest",
     *   type="object",
     *   required={
     *      "mobile"
     * },
     * @OA\Property(
     *     property="mobile",
     *     type="string",
     *     description="Enter a number at least 10 min length"
     * ),
     * )
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => 'required|numeric|min:10'
        ];
    }
}
