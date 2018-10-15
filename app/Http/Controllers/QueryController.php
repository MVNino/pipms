<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
class QueryController extends Controller
{
	public function index()
	{

		$copyrightstats = DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(applicants.int_id) as author_count, 
	        		count(case when char_copyright_status = "pending" 
	        		then 1 else null end) as copyright_count_pending, 
	        		count(case when char_copyright_status = "to submit" 
	        		then 1 else null end) as copyright_count_to_submit, 
	        		count(case when char_copyright_status = "on process" 
	        		then 1 else null end) as copyright_count_on_process, 
	        		count(case when char_copyright_status = "copyrighted" 
	        		then 1 else null end) as copyright_count_copyrighted, 
	        		departments.int_id as department_id, departments.char_department_code, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->groupBy('branches.str_branch_name')
	        ->orderBy('str_branch_name', 'desc')
	        ->limit(5)->get();

	    $patentstats = DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw(' count(case when char_patent_status = "patented" 
	        		then 1 else null end) as patent_count_patented,departments.int_id as department_id, departments.char_department_code, colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->groupBy('branches.str_branch_name')
	        ->orderBy('str_branch_name', 'desc')
	        ->limit(5)->get();

	    
		
		return view('admin.queries', ['copyrightstats'=>$copyrightstats, 'patentstats'=>$patentstats]);
	}

	public function queryInfo($param)
	{
		
	}
}