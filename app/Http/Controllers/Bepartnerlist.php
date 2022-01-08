<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bepartner;

class Bepartnerlist extends Controller
{
    function partnerlist () {
        $data = Bepartner::all();
        return view('layouts/partner',['lists'=>$data]);
    }
}
