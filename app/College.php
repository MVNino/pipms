<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class College extends Model
{
    // Table
	protected $table = 'colleges';
    //Primary Key
	protected $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;

	public function branch()
	{
		return $this->belongsTo('App\Branch', 'int_branch_id', 'int_id');
	}
	
	public function departments()
	{
		return $this->hasMany('App\Department' ,'int_college_id' ,'int_id');
	}

	public function applicants()
	{
		return $this->hasManyThrough(
			'App\Applicant',
			'App\Department',
			'int_college_id',
			'int_department_id',
			'int_id',
			'int_id'
		);
	}

	public function projects()
	{
		return $this->hasManyThrough(
			'App\Project',
			'App\Department',
			'int_college_id',
			'int_department_id',
			'int_id',
			'int_id'
		);
	}

	public function faculties()
	{
		return $this->hasManyThrough(
			'App\Faculty',
			'App\Department',
			'int_college_id',
			'int_department_id',
			'int_id',
			'int_id'
		);
	}

	public function groupByCol($status)
	{
		return $this->join('departments', 'colleges.int_id', '=', 'departments.int_college_id')
            ->join('applicants', 'departments.int_id', '=', 'applicants.int_department_id')
            ->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
            // ->where('char_copyright_status', $status)
            ->get();
	}
}
