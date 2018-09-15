<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use Notifiable;
	
    // Table
	protected $table = 'applicants';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('App\User', 'int_user_id', 'id');
	}

	public function department()
	{
		return $this->belongsTo('App\Department', 'int_department_id', 'int_id');
	}

	// Relationship of 'applicants' to 'copyrights'
	// public function copyrights()
	// {
	// 	return $this->hasMany('App\Copyright', 'int_applicant_id', 'int_id');
	// }

	public function copyright()
	{
		return $this->hasOne('App\Copyright', 'int_applicant_id', 'int_id');
	}

	public function receipt()
	{
		return $this->hasOne('App\Receipt', 'int_applicant_id', 'int_id');
	}

	// public function receipts()
	// {
	// 	return $this->hasMany('App\Receipt', 'int_applicant_id', 'int_id');
	// }

	public function coAuthors()
	{
		return $this->hasMany('App\CoAuthor', 'int_applicant_id', 'int_id');
	}

	// Relationship with intermediate model
	public function patents()
	{
		return $this->hasManyThrough(
			'App\Patent',
			'App\Copyright',
			'int_applicant_id',
			'int_copyright_id',
			'int_id',
			'int_id'
		);
	}

	public function authorAccountRequest()
	{
		return $this->hasOne('App\AuthorAccountRequest', 'int_applicant_id', 'int_id');
	}
}
