<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
		'dtm_copyrighted'
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

	public function allRecords()
	{
		return $this->with(['applicant.department.college.branch', 
			'patent', 'project', 'projectType'])
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
            ->where('char_copyright_status', $status)
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
}
