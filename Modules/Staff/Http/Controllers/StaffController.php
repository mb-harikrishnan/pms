<?php

namespace Modules\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Staff\Models\Employee;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{



    ////////// DASHBOARD  //////////////////////



    public function dashboard()
    {

        $employeeCount = Employee::count();

        return view('staff::dashboard', compact('employeeCount'));
    }


    ///////////////////////  EMPLOYEE MANAGMENT  ///////////////////


    public function add_employee()
    {

        return view('staff::add_employee');
    }



    public function save_employee(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:pms_employee_details,C_EMAIL',
            'mobile' => 'required|string|max:10',
            'username' => 'required|string|max:255|unique:pms_employee_details,C_USERNAME',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);




        DB::transaction(function () use ($request) {

            // Insert into accounting_employee_details
            $employee = Employee::create([
                'C_FNAME'    => $request->fullname,
                'C_EMAIL'    => $request->email,
                'N_MOBILE'   => $request->mobile,
                'C_USERNAME' => $request->username,
                'C_PASSWORD' => md5($request->password),
                'C_ROLE'     => $request->role,
            ]);

            // Insert into accounting_login_details
            DB::table('pms_login_details')->insert([
                'c_username' => $request->username,
                'c_password' => md5($request->password),
            ]);
        });

        return redirect()->back()->with('success', 'Employee added successfully');
    }




    public function employee_list()
    {
        $employees = DB::table('pms_employee_details as e')
            ->join('pms_department_details as d', 'e.C_ROLE', '=', 'd.n_dept_id')
            ->where('e.c_status', 'Y')
            ->select('e.*', 'd.C_NAME as department_name')
            ->get();

        return view('staff::employee_list', compact('employees'));
    }








    //////////////////  DEPARTMENT MANAGEMENT  ////////////////////



    public function add_department()
    {
        return view('staff::add_department');
    }




    public function save_department(Request $request)
    {
        $validatedData = $request->validate([
            'department_name' => 'required|max:255|unique:pms_department_details,C_NAME',
            'department_code' => 'required|max:255',
            'description'     => 'required'
        ]);

        DB::table('pms_department_details')->insert([
            'C_NAME'        => $validatedData['department_name'],
            'C_CODE'        => $validatedData['department_code'],
            'C_DESCRIPTION' => $validatedData['description'],
            'd_date'        => now(),
            'c_status'      => 'Y'
        ]);

        return redirect()->back()->with('success', 'Department added successfully');
    }



    public function department_list()
    {
        $departments = DB::table('pms_department_details')
            ->where('c_status', 'Y')
            ->orderBy('d_date', 'desc')
            ->get();

        return view('staff::department_list', compact('departments'));
    }

    public function delete_employee($id)
    {
        DB::table('pms_department_details')
            ->where('n_dept_id', $id)
            ->update([
                'c_status' => 'D',
                'd_delete_date' => now()
            ]);

        return redirect()->route('staff.department_list')
            ->with('success', 'Status changed to Deleted');
    }



    public function get_roles(Request $request)
    {
        $search = $request->search;

        $departments = DB::table('pms_department_details')
            ->where('c_status', 'Y')
            ->when($search, function ($query, $search) {
                return $query->where('C_NAME', 'like', '%' . $search . '%');
            })
            ->select('n_dept_id', 'C_NAME')
            ->get();

        $data = [];

        foreach ($departments as $dept) {   // ✅ FIXED VARIABLE
            $data[] = [
                'id' => $dept->n_dept_id,   // Primary key
                'text' => $dept->C_NAME     // Display text
            ];
        }

        return response()->json($data);
    }


    public function delete_employee_id($id)
    {
        DB::table('pms_employee_details')
            ->where('n_slno', $id)
            ->update([
                'c_status' => 'D',
                'd_delete_date' => now()
            ]);

        return redirect()->route('staff.employee_list')
            ->with('success', 'Status changed to Deleted');
    }



    public function edit_employee($id)
    {
        $employee = DB::table('pms_employee_details as e')
            ->join('pms_department_details as d', 'e.C_ROLE', '=', 'd.n_dept_id')
            ->where('e.n_slno', $id)
            ->select('e.*', 'd.C_NAME as department_name')
            ->first();

        return view('staff::edit_employee_details', compact('employee'));
    }



    public function update_employee(Request $request, $id)
    {
        $employee = Employee::where('n_slno', $id)->firstOrFail();

        $employee->C_FNAME    = $request->fullname;
        $employee->C_EMAIL    = $request->email;
        $employee->N_MOBILE   = $request->mobile;
        $employee->C_ROLE     = $request->role;
        $employee->C_USERNAME = $request->username;

        //Update password only if entered
        if (!empty($request->password)) {
            $employee->C_PASSWORD = md5($request->password);
        }

        // Insert edit date
        $employee->d_edit_date = now();   // or date('Y-m-d H:i:s')

        $employee->save();

        return redirect()->route('staff.employee_list')
            ->with('success', 'Employee updated successfully');
    }
}
