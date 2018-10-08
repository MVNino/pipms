<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Table
	protected $table = 'departments';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;

	public function college()
	{
		return $this->belongsTo('App\College', 'int_college_id', 'int_id');
	}

	public function projects()
	{
		return $this->hasMany('App\Project', 'int_department_id', 'int_id');
	}

	public function applicants()
	{
		return $this->hasMany('App\Applicant', 'int_department_id', 'int_id');
	}

	public function copyrights()
	{
		return $this->hasManyThrough(
			'App\Copyright',
			'App\Applicant',
			'int_department_id',
			'int_applicant_id',
			'int_id',
			'int_id'
		);
	}
}
