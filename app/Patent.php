<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Patent extends Model
{
    // Table
	protected $table = 'patents';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;

	protected $dates = [
		'created_at',
		'updated_at',
		'dtm_schedule',
		'dtm_to_submit',
		'dtm_on_process',
		'dtm_patented'
	];

	// Relationship of 'patents' to 'copyrights'
	public function copyright(){
		return $this->belongsTo('App\Copyright', 'int_copyright_id', 'int_id');
	}

	public function projectType()
	{
		return $this->belongsTo('App\ProjectType', 'int_project_type_id', 'int_id');
	}

	public function project()
	{
		return $this->belongsTo('App\Project', 'int_project_id', 'int_id');
	}

	// Listing of all patent records
	public function allRecords()
	{
		return $this->with(['copyright.applicant.department.college.branch', 
			'project', 'projectType'])
            ->get();
	}

	// Ranged patent records
	public function rangeAllRecords($start, $end)
	{
		return $this->with(['copyright.applicant.department.college.branch', 
			'project', 'projectType'])
			->whereBetween('created_at', [$start, $end])
            ->get();
	}

	// Range patent records by date and status
	public function rangeAllRecordsWithStatus($status, $start, $end)
	{
		return $this->with(['copyright.applicant.department.college.branch', 
			'project', 'projectType'])
			->whereBetween('created_at', [$start, $end])
			->where('char_patent_status', $status)
            ->get();
	}

	// For listing of patents with where method
	public function whereStatusIs($status)
	{
		return $this->with(['copyright.applicant.department.college.branch', 
			'project', 'projectType'])
            ->where('char_patent_status', $status)
            ->get();
	}

	// Listing of 'to submit' patent records
	public function toSubmit($status)
	{
		return $this->with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', $status)
            ->where('dtm_schedule', '!=', null)
            ->orderBy('dtm_schedule')
            ->get();
	}

	// View a 'to submit' patent record
	public function viewToSubmit($status, $id)
	{
		return $this->with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', $status)
            ->where('dtm_schedule', '!=', NULL)
            ->where('int_id', $id)
            ->get();
	}

	// For viewing specific record
	public function extractThisRecord($status, $id)
	{
		return $this->with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', $status)
            ->where('int_id', $id)
            ->get();
	}

	// Group copyright record by college
	public function groupByCollege($status)
	{
		return $this->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
			->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
            ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
            ->where('char_patent_status', $status)
            ->groupBy('departments.char_department_code')    
            ->get();
	}

	public function patentStats($column)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(applicants.int_id) as author_count,
	        		count(case when char_patent_status = "pending" 
	        		then 1 else null end) as patent_count_pending, 
	        		count(case when char_patent_status = "conflict" or 
	        		char_patent_status = "to submit/conflict" 
	        		then 1 else null end) as patent_count_to_conflict,  
	        		count(case when char_patent_status = "to submit" 
	        		then 1 else null end) as patent_count_to_submit, 
	        		count(case when char_patent_status = "on process" 
	        		then 1 else null end) as patent_count_on_process, 
	        		count(case when char_patent_status = "patented" 
	        		then 1 else null end) as patent_count_patented, 
	        		departments.int_id as department_id, departments.char_department_code, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->groupBy($column) 
	        ->get();
	}

	public function rangedPatents($column, $start, $end)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(applicants.int_id) as author_count, 
	        		count(case when char_patent_status = "pending" 
	        		then 1 else null end) as patent_count_pending, 
	        		count(case when char_patent_status = "conflict" or 
	        		char_patent_status = "to submit/conflict" 
	        		then 1 else null end) as patent_count_to_conflict, 
	        		count(case when char_patent_status = "to submit" 
	        		then 1 else null end) as patent_count_to_submit, 
	        		count(case when char_patent_status = "on process" 
	        		then 1 else null end) as patent_count_on_process, 
	        		count(case when char_patent_status = "patented" 
	        		then 1 else null end) as patent_count_patented, 
	        		departments.int_id as department_id, departments.char_department_code, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->whereBetween('patents.created_at', [$start, $end])
	        ->groupBy($column) 
	        ->get();
	}

	public function patentsOfThisUnit($unit, $unitId)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
			->join('project_types', 'patents.int_project_type_id', '=', 'project_types.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('users', 'applicants.int_user_id', '=', 'users.id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('patents.int_id, str_patent_project_title, str_first_name, 
	        	str_middle_name, str_last_name, char_gender, char_applicant_type, project_types.int_id as int_project_type_id, 
	        	project_types.char_project_type, departments.int_id as int_department_id, char_department_code, 
	        	colleges.int_id as int_college_id, char_college_code, branches.int_id as int_branch_id, str_branch_name, 
	        	patents.created_at, char_patent_status, users.id as author_id'))
	        ->where($unit, $unitId)
	        ->get();

	}

	public function rangedPatentsOfThisUnit($unit, $unitId, $start, $end)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
			->join('project_types', 'patents.int_project_type_id', '=', 'project_types.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('users', 'applicants.int_user_id', '=', 'users.id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('patents.int_id, str_patent_project_title, str_first_name, 
	        	str_middle_name, str_last_name, char_gender, char_applicant_type, project_types.int_id as int_project_type_id, 
	        	project_types.char_project_type, departments.int_id as int_department_id, char_department_code, 
	        	colleges.int_id as int_college_id, char_college_code, branches.int_id as int_branch_id, str_branch_name, 
	        	patents.created_at, char_patent_status, users.id as author_id'))
	        ->where($unit, $unitId)
	        ->whereBetween('patents.created_at', [$start, $end])
	        ->get();

	}

	// Count patented records
	public function countPatented($unit, $unitId)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
			->select(DB::raw('count(case when char_patent_status = "patented" 
	        		then 1 else null end) as patented_count'))
			->where($unit, $unitId)
			->get();		
	}

	public function miniPatentStats($unit, $unitId, $groupBy)
	{
		return DB::table('patents')
			->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(case when char_patent_status = "pending" OR 
	        		char_patent_status = "to submit" OR char_patent_status = "on process" 
	        		then 1 else null end) as patent_processing_count, 
	        		count(case when char_patent_status = "patented" 
	         		then 1 else null end) as patented_count, 
	         		count(case when char_patent_status = "conflict" 
	         		then 1 else null end) as patent_conflict_count, 
	         		int_department_id, char_department_code, 
	        		int_college_id, char_college_code'))
	        ->where($unit, $unitId)
	        ->groupBy($groupBy)
	        ->get();
	}

    // Get application issues record
    public function getApplicationConflicts($unit, $unitId)
    {
        return $this->join('copyrights', 'patents.int_copyright_id', '=', 'copyrights.int_id')
        	->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
        	->join('users', 'applicants.int_user_id', '=', 'users.id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select(DB::raw('str_first_name, str_last_name, char_college_code, 
            	char_department_code, str_branch_name, str_patent_project_title, patents.created_at'))
            ->where('char_patent_status', 'conflict')
            ->where($unit, $unitId)
            ->paginate(5);
    }
}
