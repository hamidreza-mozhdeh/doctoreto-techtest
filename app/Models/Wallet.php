<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param  int      $user_id  User Id.
     * @param  int|null $deposit  Deposit.
     * @param  int|null $withdraw Withdraw.
     * @param  int|null $balance  Balance.
     * @return Wallet
     */
    public static function createObject(
        int $user_id,
        ?int $deposit = 0,
        ?int $withdraw = 0,
        ?int $balance = 0
    ): Wallet {
        $wallet = new self();
        $wallet->user_id = $user_id;
        $wallet->deposit = $deposit;
        $wallet->withdraw = $withdraw;
        $wallet->balance = $balance;
        $wallet->save();

        return $wallet;
    }
}
