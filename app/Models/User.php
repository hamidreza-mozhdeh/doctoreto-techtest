<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
    ];

    /**
     * @return HasMany
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * @return HasMany
     */
    public function discountHistories(): HasMany
    {
        return $this->hasMany(DiscountHistory::class);
    }

    /**
     * @param string      $mobile Mobile.
     * @param string|null $name   Name.
     *
     * @return User
     */
    public static function createObject(
        string $mobile,
        ?string $name = null
    ): User {
        $user = new self();
        $user->mobile = $mobile;
        $user->name = $name;
        $user->save();

        return $user;
    }

    /**
     * @return int Return User Balance.
     */
    public function balance(): int
    {
        return (int) optional(
            $this->wallets()->orderBy('id', 'DESC')->first()
        )->balance;
    }

    /**
     * @param  int $value Value of deposit.
     * @return Wallet Wallet.
     */
    public function deposit(int $value): Wallet
    {
        $wallet = new Wallet();
        $wallet->deposit = $value;
        $wallet->balance = $value + $this->balance();
        $this->wallets()->save($wallet);

        return $wallet;
    }
}
