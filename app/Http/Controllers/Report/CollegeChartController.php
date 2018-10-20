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

    #1 
    
    
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

    #3 College Monthly Copyright / Patent Statistics
    public function getCollegeMonthlyChart($id)
    {
    	return $this->getMonthlyPatentData($id);
    	return $this->getMonthlyCopyrightData($id);

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
    	// count only ung copyrights ng college na ito
    	$copyright_count = DB::table('copyrights')
    		->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(copyrights.int_id) as copyright_count'))
	        ->whereMonth('copyrights.created_at', $month)
	        ->where('colleges.int_id', $id)
	        ->get();
        // $copyright_count = Copyright::whereMonth('created_at', $month)
        //     ->get()
        //     ->count();
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

        $max_no = max($monthlyCopyrightCountArray);
        // $maxMonthlyCopyright = round(( $max_no + 10/2 ) / 10) * 10;
        $month_array = $this->getAllMonths();
        $monthlyCopyrightCountArraydata = array(
            'months' => $monthNameArray,
            'copyright_count_data' => $monthlyCopyrightCountArray,
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
    	// count patents under this college
    	$patent_count = DB::table('patents')
    		->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
    		->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(patents.int_id) as patent_count'))
	        ->whereMonth('patents.created_at', $month)
	        ->where('colleges.int_id', $id)
	        ->get();
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

        $max_no = max($monthlyPatentCountArray);
        $month_array = $this->getAllMonths();
        $monthlyPatentCountArraydata = array(
            'patent_months' => $monthNameArray,
            'patent_count_data' => $monthlyPatentCountArray,
            'maxMonthlyPatent' => $max_no 
        );
        return $monthlyPatentCountArraydata;
    }
}
