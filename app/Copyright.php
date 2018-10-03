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

	// List pending request for copyright
	public function listPendingCopyright()
	{
        return $copyrights = Copyright::join('applicants', 'copyrights.int_applicant_id', 
            '=', 'applicants.int_id')
            ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
           ->select('copyrights.int_id', 'str_first_name', 'str_middle_name', 
                'str_last_name', 'str_project_title', 'char_college_code', 'char_applicant_type',
            'mdmTxt_project_description', 'copyrights.updated_at')
            ->where('char_copyright_status', 'pending')
            ->get();
	}
}
