<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

	// For listing of patents
	public function whereStatusIs($status)
	{
		return $this->with('copyright.applicant.department.college.branch')
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
}
