<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usr_mobile',
        'usr_fullname',
        'usr_firstname',
        'password',
        'usr_temp_psw',
        'usr_group_id',
        'usr_token',
        'usr_dob',
        'usr_sign-up',
        'usr_last_login',
        'usr_opt-out',
        'usr_group_id',
        'usr_operator_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'usr_picture'
    ];

    /**
     * Get the user's avatar initial text
     * 
     * @return string
     */
    public function getInitialAvatarTextAttribute()
    {
        $initialAvatarText = '';
        if ($this->usr_fullname) {
            $splits = explode(' ', $this->usr_fullname);

            if (count($splits) > 1) {
                $firstChar = substr($splits[0], 0, 1);
                $secondChar = substr($splits[1], 0, 1);

                $initialAvatarText = strtoupper("{$firstChar}{$secondChar}");
            } else {
                $initialAvatarText = strtoupper(substr($splits[0], 0, 2));
            }

        }

        return $initialAvatarText;
    }
}
