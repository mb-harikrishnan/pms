<?php

namespace Modules\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{



    public function add_projects()
    {

       return view('staff::projects.add_projects');
    }




    
public function get_project_parent(Request $request)
{
    $search = $request->search;

    $departments = DB::table('pms_project_details')
        ->where('c_status', 'Y')
        ->where('parent_id', 0)
        ->when($search, function ($query, $search) {
            return $query->where('c_project_name', 'like', '%' . $search . '%');
        })
        ->select('n_pjt_id', 'c_project_name')
        ->get();

    $data = [];

    foreach ($departments as $dept) {   // ✅ FIXED VARIABLE
        $data[] = [
            'id' => $dept->n_pjt_id,   // Primary key
            'text' => $dept->c_project_name     // Display text
        ];
    }


    return response()->json($data);
    
}




public function get_roles()
{
    $roles = DB::table('pms_department_details')
        ->where('c_status','Y')
        ->select('n_dept_id','C_NAME')
        ->get();

    return response()->json($roles);
}


public function get_employees(Request $request)
{
    $role_id = $request->role_id;

    $employees = DB::table('pms_employee_details')
        ->where('c_status','Y')
        ->where('C_ROLE',$role_id)
        ->select('n_slno','C_FNAME')
        ->get();

    return response()->json($employees);
}





public function save_project(Request $request)
{
    $validatedData = $request->validate([
        'project_name' => 'required|max:255',
        'parent'       => 'required',
    ]);

    DB::transaction(function () use ($request) {

        DB::table('pms_project_details')->insert([
            'c_project_name' => $request->project_name,
            'parent_id'      => $request->parent,
            'd_created_date' => now(),
            'c_status'       => 'Y'
        ]);

    });

    return redirect()->back()->with('success', 'Project added successfully');
}   



//   public function project_list()
// {
//     $projects = DB::table('pms_project_details as e')
//         ->join('pms_project_details as d', 'e.n_pjt_id', '=', 'd.parent_id')
//         ->where('e.c_status', 'Y')
//         ->select('e.*', 'd.c_project_name as name')
//         ->get();

//     return view('staff::projects.project_list', compact('projects'));
// }


public function project_list()
{
        $projects = DB::table('pms_project_details')
                    ->where('parent_id',0)
                    ->get();

        foreach ($projects as $project) {
            $project->children = DB::table('pms_project_details')
                            ->where('parent_id',$project->n_pjt_id)
                            ->get();
        }

    return view('staff::projects.project_list', compact('projects'));
}


public function saveProjectEmployee(Request $request)
{

$project_id = $request->project_id;
$description = $request->description;
$assignData = $request->assignData;


/* update project description */

DB::table('projects_team')
->where('n_pjt_id',$project_id)
->update([
'c_description'=>$description
]);


/* insert employees */

foreach($assignData as $row){

DB::table('project_employee')->insert([

'project_id'=>$project_id,
'role_id'=>$row['role'],
'employee_id'=>$row['employee'],
'created_at'=>now()

]);

}

return response()->json(['status'=>true]);

}























}
