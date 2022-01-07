<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            'guest',
            'guest:masterAdmin',
            'guest:groupAdmin',
            'guest:operator'
        ])->except([
            'masterAdminLogout',
            'groupAdminLogout',
            'operatorLogout'
        ]);
    }

    /**
     * Handle master admin login
     */
    public function masterAdminLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate form data
            $this->validate($request, [
                'login'   => 'required',
                'password' => 'required'
            ]);

            // Check the login type if it is email or username
            $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            // Merge the login field into the request with either email or username as key
            $request->merge([
                $loginType => $request->input('login')
            ]);

            $crendentials = $request->only($loginType, 'password');
            if (Auth::guard('masterAdmin')->attempt($crendentials, $request->has('remember'))) {
                return redirect()->route('masteradmin.dashboard');
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'login_failed' => 'Credential is incorrect! Try again.',
                ]);
        }

        return view('auth.masteradmin_login');
    }

    /**
     * Handle master admin logout
     */
    public function masterAdminLogout()
    {
        Auth::guard('masterAdmin')->logout();
        return redirect()->route('masteradmin.login');
    }

    /**
     * Handle group admin login
     */
    public function groupAdminLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'login' => 'required',
                'password' => 'required'
            ]);

            $crendentials = [
                'gp_groupname' => $request->login,
                'password' => $request->password
            ];

            if (Auth::guard('groupAdmin')->attempt($crendentials, $request->has('remember'))) {
                return redirect()->route('groupadmin.dashboard');
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'login_failed' => 'Credential is incorrect! Try again.',
                ]);
        }

        return view('auth.groupadmin_login');
    }

    /**
     * Handle group admin logout
     */
    public function groupAdminLogout()
    {
        Auth::guard('groupAdmin')->logout();
        return redirect()->route('groupadmin.login');
    }

    /**
     * Handle operator login
     */
    public function operatorLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'login'   => 'required',
                'password' => 'required'
            ]);

            $crendentials = [
                'opr_mobile' => $request->login,
                'password' => $request->password
            ];

            if (Auth::guard('operator')->attempt($crendentials, $request->has('remember'))) {
                return redirect()->route('operator.main');
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'login_failed' => 'Credential is incorrect! Try again.',
                ]);
        }

        return view('auth.operator_login');
    }

    /**
     * Handle operator logout
     */
    public function operatorLogout()
    {
        Auth::guard('operator')->logout();
        return redirect()->route('operator.login');
    }
}
