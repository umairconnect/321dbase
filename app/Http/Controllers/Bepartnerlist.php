<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bepartner;

class Bepartnerlist extends Controller
{
    function partnerlist () {
        $data = Bepartner::paginate(5);
        return view('layouts/header',['lists'=>$data]);
    }
}
