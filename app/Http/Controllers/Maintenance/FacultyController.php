<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\Faculty;

class FacultyController extends Controller
{
    # Controller for Faculty record maintenance
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function maintainFaculties()
    {
        $faculties = Faculty::join('departments', 'faculties.int_department_id', 
                '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', 
                '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select('faculties.int_id', 'faculties.str_first_name', 
                'faculties.str_middle_name', 'faculties.str_last_name', 
                'faculties.str_email_address', 'char_college_code', 
                'char_department_code', 'str_branch_name')
            ->get();
        $departments = Department::join('colleges', 'departments.int_college_id', 
                '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select('departments.int_id', 'char_department_code', 
                'char_college_code', 'str_branch_name')
            ->orderBy('char_college_code')
            ->get();
        return view('admin.maintenance.faculty', ['faculties' => $faculties, 
            'departments' => $departments]);
    }

    public function addFaculty(Request $request)
    {
        $this->validate($request, [
            'txtFirstName' => 'required',
            'txtLastName' => 'required',
            'txtEmail' => 'required',
            'slctDepartmentId' => 'required'
        ]);

        // Save to table 'departments'
        $faculty = new Faculty;
        $faculty->int_department_id = $request->input('slctDepartmentId');
        $faculty->str_first_name = $request->input('txtFirstName');
        $faculty->str_middle_name = $request->input('txtMiddleName');
        $faculty->str_last_name = $request->input('txtLastName');
        $faculty->str_email_address = $request->input('txtEmail');
        
        if($faculty->save()) {
        return redirect('/admin/maintenance/faculties')->with('success', 
            'Faculty record added!');
        }
    }

    public function viewFaculty($id)
    {
        $faculties = Faculty::join('departments', 'faculties.int_department_id', 
                '=', 'departments.int_id')->join('colleges', 
                'departments.int_college_id', '=', 'colleges.int_id')
            ->select('faculties.int_id', 'faculties.str_first_name', 
                'faculties.str_middle_name', 'faculties.str_last_name', 
                'faculties.str_email_address', 'char_college_code', 
                'char_department_code')
            ->where('faculties.int_id', $id)
            ->get();
        $departments = Department::orderBy('char_department_code', 'asc')
                            ->get();
        return view('admin.maintenance.view-faculty', ['faculties' => $faculties, 
            'departments' => $departments]);
    }

    public function updateFaculty(Request $request, $id)
    {
        $this->validate($request, [
            'txtFirstName' => 'required',
            'txtMiddleName' => 'required',
            'txtLastName' => 'required',
            'txtEmail' => 'required',
            'slctDepartmentId' => 'required'
        ]);
        // Save to table 'departments'
        $faculty = Faculty::find($id);
        $faculty->int_department_id = $request->input('slctDepartmentId');
        $faculty->str_first_name = $request->input('txtFirstName');
        $faculty->str_middle_name = $request->input('txtMiddleName');
        $faculty->str_last_name = $request->input('txtLastName');
        if ($faculty->str_email_address != $request->input('txtEmail')) {
            $faculty->str_email_address = $request->input('txtEmail');
        }
        $faculty->save();
        return redirect('/admin/maintenance/faculty/'.$id)->with('success', 
            'Faculty record updated!');
    }
}
