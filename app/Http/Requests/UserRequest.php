<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @OA\Property(property="mobile", type="string"),
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
