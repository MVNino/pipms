<?php

namespace App\Http\Controllers\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patent;

class PatentController extends Controller
{
    # Controller for Patent record inventory
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listPatents()
    {
        // $patents = Patent::join('project_types', 
        //     'patents.int_project_type_id', '=', 'project_types.int_id')
        //     ->join('copyrights', 'patents.int_copyright_id', 
        //         '=', 'copyrights.int_id')
        //     ->join('applicants', 'copyrights.int_applicant_id', 
        //         '=', 'applicants.int_id')
        //     ->join('departments', 'applicants.int_department_id', 
        //         '=', 'departments.int_id')
        //     ->join('colleges', 'departments.int_college_id', 
        //         '=', 'colleges.int_id')
        //     ->join('branches', 'colleges.int_branch_id', 
        //         '=', 'branches.int_id')
        //     ->select('patents.int_id', 'str_patent_project_title', 
        //         'patents.char_patent_status','applicants.str_first_name', 
        //         'applicants.str_middle_name', 'applicants.str_last_name', 
        //         'patents.mdmTxt_patent_description', 'colleges.char_college_code', 
        //         'char_project_type', 'departments.char_department_code', 
        //         'branches.str_branch_name', 'applicants.char_applicant_type', 
        //         'patents.created_at')
        //     ->get();
        $patents = Patent::all();
        return view('admin.records.list-patents', ['patents' => $patents]);
    }

    public function viewPatent($id)
    {
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.records.view-patent', 
            ['patentCollection' => $patentCollection]);
    }

}
