<?php

namespace App\Http\Controllers\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class CopyrightController extends Controller
{
    # Controller for Copyright records
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listCopyrights()
    {
        $copyrights = Copyright::join('project_types', 
            'copyrights.int_project_type_id', '=', 'project_types.int_id')
            ->join('applicants', 
        		'copyrights.int_applicant_id', '=', 'applicants.int_id')
            ->join('departments', 'applicants.int_department_id', '=', 
            	'departments.int_id')
            ->join('colleges', 'departments.int_college_id', 
                '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
           	->select('copyrights.int_id', 'char_project_type', 'str_first_name', 
                'str_middle_name', 'str_last_name', 'str_project_title', 
                'char_copyright_status','char_college_code', 
                'char_department_code', 'str_branch_name', 'char_applicant_type', 
                'copyrights.created_at')
            ->get();
        return view('admin.records.list-copyrights', ['copyrights' => $copyrights]);
    }

    public function viewCopyright($id)
    {   
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.records.view-copyright', 
            ['copyrightCollection' => $copyrightCollection]);
    }


}
