<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bepartner;

class bepartner extends Controller
{
    function partnerlist () {
        return view('partnerlist');
    }
}
