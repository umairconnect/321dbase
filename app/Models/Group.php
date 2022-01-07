<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Group extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected $guard = 'groupAdmin';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'gp_groupname',
        'password',
        'gp_temp_psw', // added temporarily, remove this on production
        'gp_status',
        'gp_company',
        'gp_cc',
        'gp_ac',
        'gp_country_id',
        'gp_country_name',
        'gp_wpp_group_id',
        'gp_state',
        'gp_city',
        'gp_district',
        'gp_address',
        'gp_zip',
        'gp_legal_name',
        'gp_legal_id',
        'gp_plan',
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
        if ($this->gp_groupname) {
            $splits = explode(' ', $this->gp_groupname);

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
