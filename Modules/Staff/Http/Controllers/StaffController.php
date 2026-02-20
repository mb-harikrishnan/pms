<?php

namespace Modules\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Staff\Models\Employee;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{
  





public function add_employee()
{
    return view('staff::add_employee');
}

public function dashboard()
{

    $employeeCount = Employee::count();
    
    return view('staff::dashboard', compact('employeeCount'));
}


public function save_employee(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:account_employee_details,C_EMAIL',
        'mobile' => 'required|string|max:10',
        'username' => 'required|string|max:255|unique:account_employee_details,C_USERNAME',
        'password' => 'required|string|min:6',
        'role' => 'required|string',
    ]);




     DB::transaction(function () use ($request) {

        // Insert into accounting_employee_details
          $employee=Employee::create([
            'C_FNAME'    => $request->fullname,
            'C_EMAIL'    => $request->email,
            'N_MOBILE'   => $request->mobile,
            'C_USERNAME' => $request->username,
            'C_PASSWORD' => md5($request->password), 
            'C_ROLE'     => $request->role,
        ]);

        // Insert into accounting_login_details
        DB::table('account_login_details')->insert([
            'c_username' => $request->username,
            'c_password' => md5($request->password), 
        ]);
        // Insert into account wallet master
         DB::table('account_wallet_master')->insert([
            'n_user_id' =>$employee->n_slno ,
            'n_amount' => 0,
        ]);
       
    });

    return redirect()->back()->with('success', 'Employee added successfully');



}


public function employee_list()
{
    $employees = Employee::where('c_status','Y')->get();
    return view('staff::employee_list', compact('employees'));



}






}