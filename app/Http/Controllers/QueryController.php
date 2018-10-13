<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Copyright;
use DB;

class QueryController extends Controller
{
	public function index()
	{
		$copyright = new Copyright;
		//return $copyright->copyrightStats('branches.str_branch_name');
		return view('admin.queries');
	}

	public function indexx()
	{
		DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(case when char_copyright_status = "copyrighted" 
	        		then 1 else null end) as copyright_count_copyrighted,branches.str_branch_name'))
	        ->groupBy('branches.str_branch_name') 
	        ->orderBy('str_branch_name', 'desc')
	        ->take(5)
	        ->get();
	        
	}

	public function queryInfo($param)
	{
		
	}
}