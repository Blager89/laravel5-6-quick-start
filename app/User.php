<?php

namespace App;

use App\Notifications\NewPassword;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Resets user password, creates DB record
     *
     * @return string
     */
    public function resetPassword()
    {
        $new_password = str_random(8);
        $this->update([
            'password' => bcrypt($new_password),
        ]);
        return $new_password;
    }

    public function sendNewPasswordNotification($new_password)
    {
        $this->notify(new NewPassword($new_password));
    }


}