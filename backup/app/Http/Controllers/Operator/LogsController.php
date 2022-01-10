<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LogsController extends Controller
{
    /**
     * Display the listing of users/sales
     * 
     * @param \App\Models\User $userModel
     * @return \Illuminate\View\View
     */
    public function index(User $userModel)
    {
        $logs = $userModel->join('logs', 'users.id', '=', 'logs.user_id')
            ->join('discounts', 'logs.discount_id', '=', 'discounts.id')
            ->where('users.usr_operator_id', auth('operator')->user()->id)
            ->select('users.usr_fullname', 'users.usr_mobile', 'logs.value', 'discounts.name')
            ->get();

        return view('operator.logs.index', compact('logs'));
    }
}
