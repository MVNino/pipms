<?php

namespace App\Http\Controllers\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Patent;

class ApplicantController extends Controller
{
	public function listApplicants()
	{
        $applicants = Applicant::join('copyrights', 'copyrights.int_applicant_id', 
                '=', 'applicants.int_id')
            ->join('departments', 'applicants.int_department_id', 
                '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 
                'branches.int_id')
            ->select('applicants.int_id', 'str_first_name', 'str_middle_name', 
                'str_last_name', 'str_email_address', 'char_college_code', 
                'char_department_code', 'str_branch_name', 'copyrights.int_id as int_copyright_id', 'char_applicant_type')
            ->get();
        return view('admin.records.list-applicants', ['applicants' => $applicants]);
	}

	public function viewApplicant($id)
	{
        $applicantCollection = Applicant::with(['department.college.branch'], ['copyright.patent'])
            ->where('applicants.int_id', $id)
            ->get();
            //         $patentCollection = Patent::join('copyrights', 'patents.int_copyright_id', 
            //     '=', 'copyrights.int_id')
            // ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
            // ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            // ->join('colleges', 'departments.int_college_id', 
            //     '=', 'colleges.int_id')
            // ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            // ->select('patents.int_id', 'int_copyright_id', 
            //     'applicants.int_id as int_applicant_id', 
            //     'departments.int_id as int_department_id', 
            //     'colleges.int_id as int_college_id', 
            //     'branches.int_id as int_branch_id', 'str_patent_project_title', 
            //     'str_project_title', 
            //     'mdmTxt_patent_description', 'char_copyright_status', 'char_patent_status', 
            //     'patents.created_at', 'patents.updated_at', 'str_first_name', 
            //     'str_middle_name', 'str_last_name', 'char_applicant_type', 
            //     'str_home_address', 'str_email_address', 'bigInt_cellphone_number', 
            //     'mdmInt_telephone_number', 'char_department_code', 
            //     'str_department_name', 'char_college_code', 'str_college_name', 
            //     'str_branch_name', 'copyrights.created_at as copyright_created_at')            
        return view('admin.records.view-applicant', 
            ['applicantCollection' => $applicantCollection]);
	}
}
