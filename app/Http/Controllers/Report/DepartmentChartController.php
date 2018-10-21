<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Department;
use App\Patent;
use DB;

class DepartmentChartController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    #2 Total IPR contributions of Department in its College
    public function getCopyrightContributionsToItsCollegeChart($id)
    {
    	// Extract this college's data
    	$department = Department::findOrFail($id);
    	$data = array();
    	/* Steps
			1. Count all ipr(copyright & patent) contributions of its college
			2. Count ipr contributions of this department
		*/
		$collegeCopyrights = $this->countCollegeCopyrightContributions($department);
		$departmentCopyrights = $this->countDepartmentCopyrightContributions($department);
		$collegePatents = $this->countCollegePatentContributions($department);
		$departmentPatents = $this->countDepartmentPatentContributions($department);
		$data = array(
			'college_copyrights' => $collegeCopyrights,
			'department_copyrights' => $departmentCopyrights,
			'college_patents' => $collegePatents,
			'department_patents' => $departmentPatents
		);
		// return $data['branch_copyrights'][0]->copyright_count;
		return $data;
    }

	// Count all ipr(copyright & patent) contributions of its college
    public function countCollegeCopyrightContributions($department)
    {
    	$column = 'colleges.int_id';
		$copyrightCount = $this->copyrightCounter($column, 
			$department->int_college_id);
		return $copyrightCount;
    }

	// Count all ipr(copyright & patent) contributions of this department
	public function countDepartmentCopyrightContributions($department)
	{
    	$column = 'departments.int_id';
		$copyrightCount = $this->copyrightCounter($column, 
			$department->int_id);
		return $copyrightCount;
	}

    public function countCollegePatentContributions($department)
    {
    	$column = 'colleges.int_id';
		$patentCount = $this->patentCounter($column, 
			$department->int_college_id);
		return $patentCount;

    }

	public function countDepartmentPatentContributions($department)
	{
    	$column = 'departments.int_id';
		$patentCount = $this->patentCounter($column, 
			$department->int_id);
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
	        		departments.int_id as department_id, departments.char_department_code,
	        		colleges.int_id as college_id, colleges.char_college_code'))
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
	        		departments.int_id as department_id, departments.char_department_code,
	        		colleges.int_id as college_id, colleges.char_college_code'))
	        ->where($column, $columnId)
	        ->get();
	}

    #3 Department Monthly Copyright / Patent Statistics
    public function getDepartmentMonthlyChart($id)
    {
        return $copyright_data = $this->getMonthlyCopyrightData($id);
    }
    // Monthly Copyrights
    public function getAllMonths()
    {
        $month_array = array();
        $months = Copyright::orderBy('created_at')->pluck('created_at');
        $months = json_decode($months);
        $months;
        if(!empty($months)) {
            foreach($months as $unformattedDate) {
                $date = new \DateTime($unformattedDate->date);
                // $month = $date->format(format:'');
                $monthName = $date->format('M');
                $monthNo = $date->format('m');

                $month_array[$monthNo] = [$monthName];
            }
        } 
        return $month_array;
    }

    public function getMonthlyDataCount($month, $id)
    {
    	// count only ung copyrights of this department
    	$copyright_count = DB::table('copyrights')
    		->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('copyrights.int_id'))
	        ->whereMonth('copyrights.created_at', $month)
	        ->where('departments.int_id', $id)
	        ->get()
            ->count();
        return $copyright_count;
    }

    public function getMonthlyCopyrightData($id)
    {
        $monthlyCopyrightCountArray = array();
        $monthArray = $this->getAllMonths();
        $monthNameArray = array();
        if(!empty($monthArray)) {
            foreach($monthArray as $monthNo => $monthName) {
                $monthlyDataCount = $this->getMonthlyDataCount($monthNo, $id);
                array_push($monthlyCopyrightCountArray, $monthlyDataCount);
                array_push($monthNameArray, $monthName);
            }
        }

        $monthlyPatentData = $this->getMonthlyPatentData($id);
        $max_no = max($monthlyCopyrightCountArray);
        // $maxMonthlyCopyright = round(( $max_no + 10/2 ) / 10) * 10;
        $month_array = $this->getAllMonths();
        $monthlyCopyrightCountArraydata = array(
            'months' => $monthNameArray,
            'copyright_count_data' => $monthlyCopyrightCountArray,
            'patent_count_data' => $monthlyPatentData,
            'maxMonthlyCopyright' => $max_no 
        );
        return $monthlyCopyrightCountArraydata;
    }

    // Monthly Patents
    public function getPatentAllMonths()
    {
        $month_array = array();
        $months = Patent::orderBy('created_at')->pluck('created_at');
        $months = json_decode($months);
        $months;
        if(!empty($months)) {
            foreach($months as $unformattedDate) {
                $date = new \DateTime($unformattedDate->date);
                // $month = $date->format(format:'');
                $monthName = $date->format('M');
                $monthNo = $date->format('m');

                $month_array[$monthNo] = [$monthName];

            }
        } 
        return $month_array;
    }

    public function getPatentMonthlyDataCount($month, $id)
    {
    	// count patents under this department
    	$patent_count = DB::table('patents')
    		->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
    		->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('patents.int_id'))
	        ->whereMonth('patents.created_at', $month)
	        ->where('departments.int_id', $id)
	        ->get()
            ->count();
        return $patent_count;
    }

    public function getMonthlyPatentData($id)
    {
        $monthlyPatentCountArray = array();
        $monthArray = $this->getPatentAllMonths();
        $monthNameArray = array();
        if(!empty($monthArray)) {
            foreach($monthArray as $monthNo => $monthName) {
                $monthlyDataCount = $this->getPatentMonthlyDataCount($monthNo, $id);
                array_push($monthlyPatentCountArray, $monthlyDataCount);
                array_push($monthNameArray, $monthName);
            }
        }
        return $monthlyPatentCountArray;
    }
}