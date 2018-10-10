<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\College;

class CollegeController extends Controller
{
	public $viewPath = 'admin.reports.';
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listColleges()
    {
    	return $col = College::join('departments', 'colleges.int_id', '=', 'departments.int_college_id')
    		->join('applicants', 'departments.int_id', '=', 'applicants.int_department_id')
    		->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
    		->select('sum(copyrights.int_id')
    		->where('char_copyright_status', 'pending')
    		->get();
    	$colleges = College::orderBy('int_id', 'asc')->get();
    	return view($this->viewPath.'list-colleges', 
    		['colleges' => $colleges]);
    }
}
