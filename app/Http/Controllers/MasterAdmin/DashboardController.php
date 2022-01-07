<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the materadmin dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('masteradmin.dashboard.index');
    }
}
