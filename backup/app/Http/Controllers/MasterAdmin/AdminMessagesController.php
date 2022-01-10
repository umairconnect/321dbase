<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminMessage;

class AdminMessagesController extends Controller
{
    /**
     * Display a listing of the admin messages
     * 
     * @param \App\Models\AdminMessage $adminMessage
     * @return \Illuminate\View\View
     */
    public function index(AdminMessage $adminMessage)
    {
        $adminMessages = $adminMessage->get();

        return view('masteradmin.admin_messages.index', compact('adminMessages'));
    }

    /**
     * Update the specified admin message in storage.
     * 
     * @param \App\Models\AdminMessage $adminMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, AdminMessage $adminMessage)
    {
        $validator = Validator::make($request->all(), [
            'msg_body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-messages.index')
                ->with('error', 'Admin Message not updated.');
        }

        $data = $request->merge([
            'msg_img' => $request->image ? $request->image->store('admin-message-pictures', 'public') : null,
        ])->except([$request->hasFile('image') ? '' : 'msg_img']);

        $adminMessage->update($data);

        return redirect()->route('admin-messages.index')
            ->with('success', 'Admin Message successfully updated.');
    }

}
