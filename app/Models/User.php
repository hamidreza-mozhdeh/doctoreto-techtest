<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     * @param string   $mobile Mobile.
     * @param string|null $name Name.
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
}
