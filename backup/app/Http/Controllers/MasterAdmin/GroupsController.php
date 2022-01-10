<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;

use App\Models\Group;
use App\Http\Requests\GroupsRequest;

class GroupsController extends Controller
{
    /**
     * Display a listing of the groups
     * 
     * @param \App\Models\Group $group
     * @return \Illuminate\View\View
     */
    public function index(Group $group)
    {
        $groups = $group->orderBy('created_at', 'desc')->get();

        return view('masteradmin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group
     * 
     * @return \Illuminate\View\View 
     */
    public function create()
    {
        $groupStatuses = DB::table('group_statuses')->get();
        return view('masteradmin.groups.create', compact('groupStatuses'));
    }

    /**
     * Store a newly created group in storage.
     * 
     * @param \App\Http\Requests\GroupsRequest  $request
     * @param \App\Models\Group $groupModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupsRequest $request, Group $groupModel)
    {
        $group = array_merge($request->except(['password', 'gp_dob']), [
            'password' => Hash::make($request->password),
            'gp_temp_psw' => $request->password,
            // 'gp_dob' => Carbon::parse($request->gp_dob)->format('Y-m-d'),
        ]);

        $groupModel->create($group);

        return redirect()->route('groups.index')
            ->with('success', 'Group successfully created.');
    }

    /**
     * Show the form for editing the specified group resource.
     * 
     * @param \App\Models\Group  $group
     * @return \Illuminate\View\View
     */
    public function edit(Group $group)
    {
        $groupStatuses = DB::table('group_statuses')->get();
        return view('masteradmin.groups.edit', compact('group', 'groupStatuses'));
    }

    /**
     * Update the specified group in storage.
     * 
     * @param  \App\Http\Requests\GroupsRequest  $request
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GroupsRequest $request, Group $group)
    {
        $data = $request->except(['password']);
        if ($request->account_info_change) {
            $data['password'] = Hash::make($request->password);
            $data['gp_temp_psw'] = $request->password;
        }

        $group->update($data);

        return redirect()->route('groups.index')
            ->with('success', 'Group successfully updated.');
    }

    /**
     * Remove the specified group from storage
     * 
     * @param @param \App\Models\Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            'result' => 'success',
            'message' => 'Group has been deleted.'
        ]);
    }
}
