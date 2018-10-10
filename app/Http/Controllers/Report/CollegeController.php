<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\College;
use App\Copyright;

class CollegeController extends Controller
{
	public $viewPath = 'admin.reports.';
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listColleges()
    {
        // PAANO ung counting
    	// return $col = College::join('departments', 'colleges.int_id', '=', 'departments.int_college_id')
    	// 	->join('applicants', 'departments.int_id', '=', 'applicants.int_department_id')
    	// 	->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
    	// 	->select('sum(copyrights.int_id')
    	// 	->where('char_copyright_status', 'pending')
    	// 	->get();
    	$colleges = College::orderBy('int_id', 'asc')->get();
        // return $this->depts($colleges);
        // foreach ($colleges as $key => $value) {
        $collegeCopyrights = Copyright::all();
        $copyrights = Copyright::all();          
        // }
    	return view($this->viewPath.'list-colleges', 
    		['colleges' => $colleges, 'copyrights' => $copyrights]);
    }

    public function depts($colleges)
    {
        $val;
        $k;
        foreach($colleges as $key => $value) {
            $key = $key + 1;
            $val = $value;
        }   
        return $val;
    }
}
