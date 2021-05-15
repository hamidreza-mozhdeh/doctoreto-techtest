<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class DiscountHistory extends Model
{
    use HasFactory;

    /*
     * Limiting for each discount code
     * */
    public const usageLimit = 10;

    /*
     * Discount Deposit
     * */
    public const discountDeposit = 2000;

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function discountCodes(): BelongsTo
    {
        return $this->belongsTo(DiscountCode::class);
    }

    /**
     * @param DiscountCode $discountCode Discount Code.
     * @param User $user User.
     *
     * @return DiscountHistory
     */
    public static function createObject(
        DiscountCode $discountCode,
        User $user
    ): DiscountHistory {
        $discountHistory = new self();
        $discountHistory->discount_code_id = $discountCode->id;
        $discountHistory->user_id = $user->id;
        $discountHistory->save();

        return $discountHistory;
    }

    /**
     * @param $discountCode DiscountCode.
     * @param $user User.
     *
     * @return mixed
     */
    public static function applyDiscountCode(DiscountCode $discountCode, User $user): DiscountHistory
    {
        return DB::transaction(function () use ($discountCode, $user) {
            $discountHistory = DiscountHistory::createObject(
                $discountCode,
                $user
            );
            $user->discountHistories()->save($discountHistory);
            $discountCode->increment('number_used');
            $user->deposit(DiscountHistory::discountDeposit);

            return $discountHistory;
        });
    }

    /**
     * @param DiscountCode $discountCode Discount Code.
     * @param User $user User.
     *
     * @return mixed
     */
    public static function usingCodeFirstTime(
        DiscountCode $discountCode,
        User $user
    )
    {
        return DiscountHistory::where('discount_code_id', $discountCode->id)
            ->where('user_id', $user->id)->exists();
    }
}
