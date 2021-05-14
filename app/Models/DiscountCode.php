<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    /**
     * @param string   $code       Discount Code.
     * @param int|null $numberUsed Number Used.
     *
     * @return DiscountCode
     */
    public static function createObject(
        string $code,
        ?int $numberUsed = 0
    ): DiscountCode {
        $discountCode = new self();
        $discountCode->code = $code;
        $discountCode->number_used = $numberUsed;
        $discountCode->save();

        return $discountCode;
    }
}
