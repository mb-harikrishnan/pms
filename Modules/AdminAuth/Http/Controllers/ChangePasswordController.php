<?php

namespace Modules\AdminAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

use DB;
use Session;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('adminauth::change-password');
    }

    public function checkOldPassword(Request $request)
    {
        $userId = session('admin_id');

        $user = DB::table('account_login_details')
            ->where('n_admin_id', $userId)
            ->first();

        if (!$user) {
            return response()->json(['valid' => false]);
        }

        // Check old password matches DB (md5)
        if ($user->c_password === md5($request->old_password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $userId = session('admin_id');

        try {

            DB::beginTransaction();

            $user = DB::table('account_login_details')
                ->where('n_admin_id', $userId)
                ->lockForUpdate() 
                ->first();

            if (!$user) {
                DB::rollBack();
                return back()->with('error', 'User not found');
            }

            // Check old password
            if ($user->c_password !== md5($request->old_password)) {
                DB::rollBack();
                return back()->with('error', 'Old password is incorrect');
            }

            // Update password
            DB::table('account_login_details')
                ->where('n_admin_id', $userId)
                ->update([
                    'c_password' => md5($request->new_password)
                ]);

            DB::commit();

            return back()->with('success', 'Password updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}