<?php

namespace Modules\AdminAuth\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session ;

class AdminAuthController extends Controller
{


public function login()
{
    return view('adminauth::login');
}


public function login_check(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|min:6',
    ]);

    $admin = DB::table('account_login_details')
        ->where('c_username', $request->username)
        ->first();

    if (!$admin) {
        return back()->with('error', 'Invalid username or password');
    }

    // ✅ MD5 password check
    if (md5($request->password) !== $admin->c_password) {
        return back()->with('error', 'Invalid username or password');
    }

    // ✅ Update last login time
    DB::table('account_login_details')
        ->where('n_admin_id', $admin->n_admin_id)
        ->update([
            'd_last_login' => now(),
        ]);

    // ✅ Store session
    Session::put('admin_id', $admin->n_admin_id);
    Session::put('admin_username', $admin->c_username);

    // ✅ Redirect to Staff module dashboard
    return redirect()->route('staff.dashboard');
}






public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Logout Successfully');
    }




}
