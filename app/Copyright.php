<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Copyright extends Model
{
    // Table
	protected $table = 'copyrights';
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
		'dtm_copyrighted',
		'dtm_start',
		'dtm_end'
	];

	public function user(){
		return $this->belongsTo('App\User', 'int_user_id', 'id');
	}

	public function patent(){
		return $this->hasOne('App\Patent', 'int_copyright_id', 'int_id');
	}

	public function applicant(){
		return $this->belongsTo('App\Applicant', 'int_applicant_id', 'int_id');
	}

	public function project(){
		return $this->belongsTo('App\Project', 'int_project_id', 'int_id');
	}

	public function projectType()
	{
		return $this->belongsTo('App\ProjectType', 'int_project_type_id', 'int_id');
	}

	public function requirements()
	{
		return $this->hasMany('App\CopyrightRequirementList', 'int_copyright_id', 'int_id');
	}

	
	public function receipt()
	{
		return $this->hasManyThrough(
			'App\Receipt',
			'App\Applicant',
			'int_applicant_id',
			'int_applicant_id',
			'int_id',
			'int_id'
		);
	}	

	// Listing of all copyright records
	public function allRecords()
	{
		return $this->with(['applicant.department.college.branch', 
			'patent', 'project', 'projectType'])
            ->get();
	}

	// Range copyright records by date
	public function rangeAllRecords($start, $end)
	{
		return $this->with(['applicant.department.college.branch', 
			'project', 'projectType'])
			->whereBetween('created_at', [$start, $end])
            ->get();
	}

	// Range copyright records by date and status
	public function rangeAllRecordsWithStatus($status, $start, $end)
	{
		return $this->with(['applicant.department.college.branch', 
			'project', 'projectType'])
			->whereBetween('created_at', [$start, $end])
			->where('char_copyright_status', $status)
            ->get();
	}

	// Listing of copyright records with 'where'
	public function whereStatusIs($status)
	{
		return $this->with(['applicant.department.college.branch', 
			'patent', 'project', 'projectType'])
            ->where('char_copyright_status', $status)
            ->get();
	}

	// Listing of 'to submit' copyright records
	public function toSubmit($status)
	{
		return $this->with('applicant.department.college.branch')
            ->where('char_copyright_status', 'LIKE', '%'.$status.'%')
            ->where('dtm_schedule', '!=', null)
            ->orderBy('dtm_schedule')
            ->get();
	}

	// View a 'to submit' copyright record
	public function viewToSubmit($status, $id)
	{
		return $this->with('applicant.department.college.branch')
            ->where('char_copyright_status', $status)
            ->where('dtm_schedule', '!=', NULL)
            ->where('int_id', $id)
            ->get();
	}

	// View a 'to submit' copyright record
	public function viewToSubmitConflict($id)
	{
		return $this->with('applicant.department.college.branch')
            ->orWhere('char_copyright_status', 'to submit/conflict')
            ->where('dtm_schedule', '!=', NULL)
            ->where('int_id', $id)
            ->get();
	}

	// View specific copyright record
	public function extractThisRecord($status, $id)
	{
		return $this->with('applicant.department.college.branch')
            ->where('char_copyright_status', $status)
            ->where('int_id', $id)
            ->get();
	}

	// Group copyright record by college
	public function groupByCollege($status)
	{
		return $this->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
            ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
            ->where('char_copyright_status', $status)
            ->get();
	}

	// Copyright Figures per Department/College/Branch
	public function copyrightStats($column)
	{
		return DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(applicants.int_id) as author_count, 
	        		count(case when char_copyright_status = "pending" 
	        		then 1 else null end) as copyright_count_pending, 
	        		count(case when char_copyright_status = "conflict" or 
	        		char_copyright_status = "to submit/conflict" 
	        		then 1 else null end) as copyright_count_to_conflict, 
	        		count(case when char_copyright_status = "to submit" 
	        		then 1 else null end) as copyright_count_to_submit, 
	        		count(case when char_copyright_status = "on process" 
	        		then 1 else null end) as copyright_count_on_process, 
	        		count(case when char_copyright_status = "copyrighted" 
	        		then 1 else null end) as copyright_count_copyrighted, 
	        		departments.int_id as department_id, departments.char_department_code, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->groupBy($column) 
	        ->get();
	}

	public function rangedCopyrights($column, $start, $end)
	{
		return DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(applicants.int_id) as author_count, 
	        		count(case when char_copyright_status = "pending" 
	        		then 1 else null end) as copyright_count_pending, 
	        		count(case when char_copyright_status = "conflict" or 
	        		char_copyright_status = "to submit/conflict" 
	        		then 1 else null end) as copyright_count_to_conflict, 
	        		count(case when char_copyright_status = "to submit" 
	        		then 1 else null end) as copyright_count_to_submit, 
	        		count(case when char_copyright_status = "on process" 
	        		then 1 else null end) as copyright_count_on_process, 
	        		count(case when char_copyright_status = "copyrighted" 
	        		then 1 else null end) as copyright_count_copyrighted, 
	        		departments.int_id as department_id, departments.char_department_code, 
	        		colleges.int_id as college_id, colleges.char_college_code, 
	        		branches.int_id as branch_id, branches.str_branch_name'))
	        ->whereBetween('copyrights.created_at', [$start, $end])
	        ->groupBy($column) 
	        ->get();	
	}

	// Copyright Statistics/Records per College
	public function copyrightsOfThisUnit($unit, $unitId)
	{
		return DB::table('copyrights')
			->join('project_types', 'copyrights.int_project_type_id', '=', 'project_types.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('users', 'applicants.int_user_id', '=', 'users.id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('copyrights.int_id, str_project_title, str_first_name, 
	        	str_middle_name, str_last_name, char_gender, char_applicant_type, project_types.int_id as int_project_type_id, 
	        	project_types.char_project_type, departments.int_id as int_department_id, char_department_code, 
	        	colleges.int_id as int_college_id, char_college_code, branches.int_id as int_branch_id, str_branch_name, 
	        	copyrights.created_at, char_copyright_status, users.id as author_id'))
	        ->where($unit, $unitId)
	        ->get();
	}

	// Ranged Copyright Statistics/Records per College
	public function rangedCopyrightsOfThisUnit($unit, $unitId, $start, $end)
	{
		return DB::table('copyrights')
			->join('project_types', 'copyrights.int_project_type_id', '=', 'project_types.int_id')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('users', 'applicants.int_user_id', '=', 'users.id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('copyrights.int_id, str_project_title, str_first_name, 
	        	str_middle_name, str_last_name, char_gender, char_applicant_type, project_types.int_id as int_project_type_id, 
	        	project_types.char_project_type, departments.int_id as int_department_id, char_department_code, 
	        	colleges.int_id as int_college_id, char_college_code, branches.int_id as int_branch_id, str_branch_name, 
	        	copyrights.created_at, char_copyright_status, users.id as author_id'))
	        ->where($unit, $unitId)
	        ->whereBetween('copyrights.created_at', [$start, $end])
	        ->get();
	}

	// Count copyrighted records
	public function countCopyrighted($unit, $unitId)
	{
		return DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
			->select(DB::raw('count(case when char_copyright_status = "copyrighted" 
	        		then 1 else null end) as copyrighted_count'))
			->where($unit, $unitId)
			->get();		
	}

	public function miniCopyrightStats($unit, $unitId, $groupBy)
	{
		return DB::table('copyrights')
	        ->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
	        ->select(DB::raw('count(case when char_copyright_status = "pending" OR 
	        		char_copyright_status = "to submit" OR char_copyright_status = "on process" 
	        		then 1 else null end) as copyright_processing_count, 
	        		count(case when char_copyright_status = "copyrighted" 
	        		then 1 else null end) as copyrighted_count, 
	        		count(case when char_copyright_status = "conflict" 
	        		then 1 else null end) as copyright_conflict_count, 
	        		int_department_id, char_department_code, 
	        		int_college_id, char_college_code'))
	        ->where($unit, $unitId)
	        ->groupBy($groupBy)
	        ->get();
	}

    // Get application issues record from every unit(branch/college)
    public function getApplicationConflicts($unit, $unitId, $status)
    {
        return $this->join('applicants', 'copyrights.int_applicant_id', '=', 'applicants.int_id')
        	->join('users', 'applicants.int_user_id', '=', 'users.id')
	        ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
	        ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
	        ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select(DB::raw('copyrights.int_id, users.id as int_user_id, str_first_name, str_last_name, int_college_id, char_college_code, 
            	int_department_id, char_department_code, str_branch_name, str_project_title, copyrights.created_at'))
            ->where('char_copyright_status', $status)
            ->where($unit, $unitId)
            ->paginate(5);
    }

    // Extract copyright application records /w conflict
    public function listApplicationIssues($start = NULL, $end = NULL){
    	if ($start == NULL AND $end == NULL) {
    		return $this->where('char_copyright_status', 'conflict')
    			->orWhere('char_copyright_status', 'to submit/conflict')
	    		->orderBy('created_at', 'desc')
    			->get();
    	} else {
    		return $this->whereBetween('created_at', [$start, $end])
    		    ->where(function ($query) { 
    		        $query->where('char_copyright_status', 'conflict') 
    		              ->orWhere('char_copyright_status', 'to submit/conflict'); 
    		    })
	    		->orderBy('created_at', 'desc')
    		    ->get();
    	}
    }
}
