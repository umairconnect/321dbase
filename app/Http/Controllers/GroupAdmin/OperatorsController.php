<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;

use App\Models\Operator;
use App\Http\Requests\OperatorsRequest;

class OperatorsController extends Controller
{
    /**
     * Display a listing of the operators in group
     * 
     * @param \App\Models\Operator $operatorModel
     * @return \Illuminate\View\View
     */
    public function index(Operator $operatorModel)
    {
        $operators =  $operatorModel->leftJoin('operator_roles', 'operator_roles.id', '=', 'operators.opr_role_id')
            ->where('operators.opr_group_id', auth('groupAdmin')->user()->id)
            ->select('operators.*', 'operator_roles.*')
            ->get();

        $roles = DB::table('operator_roles')->get();
        return view('groupadmin.operators.index', compact('operators', 'roles'));
    }

    /**
     * Store a newly created operator in storage.
     * 
     * @param \App\Http\Requests\OperatorsRequest $request
     * @param \App\Models\Operator $operatorModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OperatorsRequest $request, Operator $operatorModel)
    {
        $operator = array_merge($request->except(['password']), [
            'password' => Hash::make($request->password),
            'opr_temp_psw' => $request->password,
            'opr_group_id' => auth('groupAdmin')->user()->id
        ]);

        $operatorModel->create($operator);

        return redirect()->route('operators.index')->with('success', 'Operator successfully added.');
    }

        /**
     * Show the form for editing the specified operator resource.
     * 
     * @param \App\Models\Operator $operator
     * @return \Illuminate\View\View
     */
    public function edit(Operator $operator)
    {
        $roles = DB::table('operator_roles')->get();

        return view('groupadmin.operators.edit', compact('operator', 'roles'));
    }

    /**
     * Update the specified operator in storage.
     * 
     * @param  \App\Http\Requests\OperatorsRequest  $request
     * @param \App\Models\Operator $operator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperatorsRequest $request, Operator $operator)
    {
        $data = $request->except(['password']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
            $data['opr_temp_psw'] = $request->password;
        }

        $operator->update($data);

        return redirect()->route('operators.index')->with('success', 'Operator successfully updated.');
    }

    /**
     * Remove the specified operator from storage
     * 
     * @param \App\Models\Operator $operator
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Operator $operator)
    {
        $operator->delete();

        return response()->json([
            'result' => 'success',
            'message' => 'Operator has been deleted.'
        ]);
    }
}
