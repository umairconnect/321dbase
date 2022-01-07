<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Log;
use App\Models\User;

class MainController extends Controller
{
    /**
     * Display the main page of operator panel
     * 
     * @param \App\Models\Discount $discountModel
     * @return \Illuminate\View\View
     */
    public function index(Discount $discountModel)
    {
        $discounts = $discountModel->get();

        return view('operator.main.index', compact('discounts'));
    }

    /**
     * Store a newly created user/sales in storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @param \App\Models\User $userModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $userModel, Log $logModel)
    {
        $validator = Validator::make($request->only('usr_mobile'), [
            'usr_mobile' => 'unique:users',
        ]);

        if ($validator->fails()) {
            $customerName = $userModel->where('usr_mobile', $request->usr_mobile)->first()->usr_fullname;
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'user-already-exist-error' => "There is already a customer with his mobile number named <b>{$customerName}</b>"
                ]);
        }

        $userData = array_merge($request->only(['usr_fullname', 'usr_mobile']), [
            'usr_group_id' => auth('operator')->user()->opr_group_id,
            'usr_operator_id' => auth('operator')->user()->id
        ]);

        $user = $userModel->create($userData);

        $logModel->create([
            'value' => $request->value,
            'discount_id' => $request->discount_id,
            'user_id' => $user->id
        ]);

        return redirect()->route('operator.main')->with('success', 'Data successfully saved.');
    }

    /**
     * Update the specified user/sales in storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @param \App\Models\User $userModel
     * @param \App\Models\Log $logModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $userModel, Log $logModel)
    {
        // Get the user already exist by mobile number
        $user = $userModel->where('usr_mobile', $request->usr_mobile)->first();

        // Update fullname
        $user->update($request->only(['usr_fullname']));
        
        // Update log data
        $logModel->where('user_id', $user->id)->update($request->only(['discount_id', 'value']));
        

        return redirect()->route('operator.main')
            ->with('success', 'Data successfully updated.');
    }
}
