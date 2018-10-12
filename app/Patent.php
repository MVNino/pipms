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
}
