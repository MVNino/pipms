<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\College;
use App\Copyright;
use App\Department;
use App\Patent;
use Carbon\Carbon;
use DB;

class CollegeChartController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    #1 Monthly Report for College's Copyright and Patent
    public function getCollegeMonthlyChart()
    {

    }
    
    #2 Total IPR contributions of College in its Branch
    public function getCopyrightContributionsToItsBranchChart($id)
    {
    	// Extract this college's data
    	$college = College::findOrFail($id);
    	$data = array();
    	/* Steps
			1. Count all ipr(copyright & patent) contributions of its branch
			2. Count ipr contributions of this college 
		*/
		$branchCopyrights = $this->countBranchCopyrightContributions($college);
		$collegeCopyrights = $this->countCollegeCopyrightContributions($college);
		$branchPatents = $this->countBranchPatentContributions($college);
		$collegePatents = $this->countCollegePatentContributions($college);
		$data = array(
			'branch_copyrights' => $branchCopyrights,
			'college_copyrights' => $collegeCopyrights,
			'branch_patents' => $branchPatents,
			'college_patents' => $collegePatents
		);
		// return $data['branch_copyrights'][0]->copyright_count;
		return $data;
    }

	// Count all ipr(copyright & patent) contributions of its branch
    public function countBranchCopyrightContributions($college)
    {
    	$column = 'branches.int_id';
		$copyrightCount = $this->copyrightCounter($column, 
			$college->int_branch_id);
		return $copyrightCount;
    }

	// Count all ipr(copyright & patent) contributions of this college
	public function countCollegeCopyrightContributions($college)
	{
    	$column = 'colleges.int_id';
		$copyrightCount = $this->copyrightCounter($column, 
			$college->int_id);
		return $copyrightCount;
	}

    public function countBranchPatentContributions($college)
    {
    	$column = 'branches.int_id';
		$patentCount = $this->patentCounter($column, 
			$college->int_branch_id);
		return $patentCount;

    }

	public function countCollegePatentContributions($college)
	{
    	$column = 'colleges.int_id';
		$patentCount = $this->patentCounter($column, 
			$college->int_id);
		return $patentCount;

	}

	public function copyrightCounter($column, $columnId)
	{
		return DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(copyrights.int_id) as copyright_count, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->where($column, $columnId)
	        ->get();
	}

	public function patentCounter($column, $columnId)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(patents.int_id) as patent_count, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->where($column, $columnId)
	        ->get();
	}

    #3 IPR Contributions of College's Departments
    public function getDepartmentContributionsChart($id)
    {
    	/*	Steps:
			1. Get all departments
			2. Count their copyrights & patents data
    	*/ 
		$data = array();
		$deptCopyrights = $this->getDepartmentCopyrightContributions($id);
		$deptPatents = $this->getDepartmentPatentContributions($id);	
		$data = array(
			'deptCopyrights' => $deptCopyrights,
			'deptPatents' => $deptPatents
		);
		return $data;
    }

    public function getDepartmentCopyrightContributions($id)
    {
    	$departments = DB::table('departments')
			->join('colleges', 'colleges.int_id', '=', 'departments.int_college_id')
			->join('applicants', 'departments.int_id', '=', 'applicants.int_department_id')
			->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
			->select(DB::raw('count(copyrights.int_id) as copyright_count, 
				char_department_code, char_college_code'))
			->where('colleges.int_id', $id)
			->groupBy('char_department_code')
			->get();
		return $departments;
    }

    public function getDepartmentPatentContributions($id)
    {
    	$departments = DB::table('departments')
			->join('colleges', 'colleges.int_id', '=', 'departments.int_college_id')
			->join('applicants', 'departments.int_id', '=', 'applicants.int_department_id')
			->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
			->join('patents', 'copyrights.int_id', '=', 'patents.int_copyright_id')
			->select(DB::raw('count(patents.int_id) as patent_count, 
				char_department_code, char_college_code'))
			->where('colleges.int_id', $id)
			->groupBy('char_department_code')
			->get();
		return $departments;
    }

}
