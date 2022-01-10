<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class MasterAdmin extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected $guard = 'masterAdmin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
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

    /**
     * Get the user's avatar initial text
     * 
     * @return string
     */
    public function getInitialAvatarTextAttribute()
    {
        $initialAvatarText = '';
        if ($this->name) {
            $splits = explode(' ', $this->name);

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
