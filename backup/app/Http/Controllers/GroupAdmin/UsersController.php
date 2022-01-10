<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Hash;

use App\Http\Requests\UsersRequest;
use App\Models\User;

use PhpOffice\PhpSpreadsheet\IOFactory; // PhpOffice Spreadsheet IOFactory


class UsersController extends Controller
{
    /**
     * Display a listing of the users in group
     * 
     * @param \App\Models\User $userModel
     * @return \Illuminate\View\View
     */
    public function index(User $userModel)
    {
        $users = $userModel->where('usr_group_id', auth('groupAdmin')->user()->id)->get();

        return view('groupadmin.users.index', compact('users'));
    }

    /**
     * Store a newly created user in storage.
     * 
     * @param \App\Http\Requests\UsersRequest  $request
     * @param \App\Models\User $userModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request, User $userModel)
    {
        $user = array_merge($request->except(['password', 'usr_dob']), [
            'password' => Hash::make($request->password),
            'usr_temp_psw' => $request->password,
            'usr_dob' => Carbon::parse($request->usr_dob)->format('Y-m-d'),
            'usr_group_id' => auth('groupAdmin')->user()->id
        ]);

        $userModel->create($user);

        return redirect('group/users')->with('success', 'User successfully added.');
    }

    /**
     * Show the form for editing the specified user resource.
     * 
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('groupadmin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     * 
     * @param  \App\Http\Requests\UsersRequest  $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UsersRequest $request, User $user)
    {
        $data = $request->except(['password', 'usr_dob']);
        $data['usr_dob'] = Carbon::parse($request->usr_dob)->format('Y-m-d');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
            $data['usr_temp_psw'] = $request->password;
        }

        $user->update($data);

        return redirect('/group/users')->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified user from storage
     * 
     * @param int|array ids
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $ids)
    {
        $ids = explode(',', $ids);
        User::whereIn('id', $ids)->delete();

        if ($request->ajax()) {
            return response()->json([
                'result' => 'success',
                'message' => 'User has been deleted.'
            ]);
        }
        return redirect('/group/users')->with('success', 'User/Users deleted.');
    }

    /**
     * Bulk store users by excel importing
     * 
     * @param \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\JsonResponse
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulkAdd(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $validator = Validator::make($request->only('excel_file'), [
                'excel_file' => 'required|mimes:xls,xlsx,csv',
            ]);

            if ($validator->fails()) {
                // return response()->josn([
                //     'result' => 'error',
                //     'message' => 'Unsupported file type.'
                // ]);
                return redirect('/group/users')->with('error', 'Unsupported file type.');
            }

            $file = $request->file('excel_file');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $fileExtension;
            $tempUploadPath = public_path('temp');

            set_time_limit(0); // Set time limit to 0

            // Storage file temporarily
            $file->move($tempUploadPath, $fileName);

            $filePath = public_path('temp/' . $fileName);

            $fileType = IOFactory::identify($filePath);
            $reader = IOFactory::createReader($fileType);

            $spreadsheet = $reader->load($filePath); // Load spreadsheet data

            unlink($filePath); // Delete file from temp

            $data = $spreadsheet->getActiveSheet()->toArray();
            unset($data[0]);

            $insertRows = [];
            foreach ($data as $key => $row) {
                $rowData = [
                    'usr_firstname' => $row[0],
                    'usr_fullname' => $row[1],
                    'usr_mobile' => $row[2],
                    'usr_dob' => $row[3],
                    'password' => $row[4]
                ];

                $validator = Validator::make($rowData, [
                    'usr_firstname' => 'required',
                    'usr_fullname' => 'required',
                    'usr_mobile' => 'required|unique:users',
                    'usr_dob' => 'required',
                    'password' => 'required'
                ]);

                if ($validator->fails()) {
                    // return response()->json([
                    //     'result' => 'error',
                    //     'message' => "Error happened on {$key}th row. Email/Mobile number must be unique or Confirm field full filled."
                    // ]);
                    return redirect('/group/users')
                        ->with('error', "Error happened on {$key}th row. Mobile number must be unique or Confirm field full filled.");
                }

                // Check if user is duplicated in excel file. (hint: email and mobile nubmer must be unique)
                $filtered = array_filter($insertRows, function($item) use($rowData) {
                    // return $item['email'] == $rowData['email'] || $item['mobile_number'] == $rowData['mobile_number'];
                    return $item['usr_mobile'] == $rowData['usr_mobile'];
                });
                if (!empty($filtered)) {
                    // return response()->json([
                    //     'result' => 'error',
                    //     'message' => "Error on {$key}th row. Email or Mobile number already used."
                    // ]);
                    return redirect('/group/users')
                        ->with('error', "Error on {$key}th row. Mobile number already used.");
                }

                $insertRows[] = [
                    'usr_firstname' => $rowData['usr_firstname'],
                    'usr_fullname' => $rowData['usr_fullname'],
                    'usr_mobile' => $rowData['usr_mobile'],
                    'usr_dob' => Carbon::parse($rowData['usr_dob'])->format('Y-m-d'),
                    // 'email' => $rowData['email'],
                    'password' => Hash::make($rowData['password']),
                    'usr_temp_psw' => $rowData['password'],
                    'usr_group_id' => auth('groupAdmin')->user()->id,
                    'created_at' => date('Y-m-d h:i:s')
                ];
            }
            
            // bulk insert
            User::insert($insertRows);

            // return response()->json([
            //     'result' => 'success',
            //     'message' => 'Successfully inserted.'
            // ]);
            return redirect('/group/users')
                ->with('success', 'Successfully inserted.');
        } else {
            // return response()->json([
            //     'result' => 'error',
            //     'message' => 'File is empty.'
            // ]);
            return redirect('/group/users')
                ->with('error', 'File is empty.');
        }
    }
}
