<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactdata;

class Contactdatas extends Controller
{
    function contactdata () {
        $data = Contactdata::paginate(5);
        return view('layouts/contactdata',['lists'=>$data]);
    }
}
