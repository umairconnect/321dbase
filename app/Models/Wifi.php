<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wifi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'mac_wan',
        'mac_lan',
        'bssid',
        'nasid',
        'channel',
        'city',
        'router_os',
        'firmware',
    ];
}
