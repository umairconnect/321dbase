<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Http\Requests\DiscountsRequest;

class DiscountsController extends Controller
{
    /**
     * Display a listing of discount
     * 
     * @param \App\Models\Discount $discountModel
     * @return \Illuminate\View\View
     */
    public function index(Discount $discountModel)
    {
        $discounts = $discountModel->get();
        return view('groupadmin.discounts.index', compact('discounts'));
    }

    /**
     * Store a newly created discount in storage.
     * 
     * @param \App\Http\Requests\DiscountsRequest  $request
     * @param \App\Models\Discount $discountModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DiscountsRequest $request, Discount $discountModel)
    {
        $discount = array_merge($request->all(), [
            'group_id' => auth('groupAdmin')->user()->id
        ]);

        $discountModel->create($discount);

        return redirect('group/discounts')->with('success', 'Discount successfully added.');
    }

    /**
     * Remove the specified discount from storage
     * 
     * @param @param \App\Models\Discount $discount
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response()->json([
            'result' => 'success',
            'message' => 'Discount has been deleted.'
        ]);
    }
}
