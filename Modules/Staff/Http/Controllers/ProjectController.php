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



  public function project_list()
{
    $employees = DB::table('pms_project_details as e')
        ->join('pms_project_details as d', 'e.n_pjt_id', '=', 'd.c_parent_id')
        ->where('e.c_status', 'Y')
        ->select('e.*', 'd.c_project_name as name')
        ->get();

    return view('staff::projects::project_list', compact('projects'));
}























}
