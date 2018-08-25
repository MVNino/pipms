<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    // Table
	protected $table = 'faculties';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = false;

	public function user()
	{
		return $this->hasOne('App\User', 'int_user_id', 'id');
	}

	public function department()
	{
		return $this->belongsTo('App\Department', 'int_department_id', 'int_id');
	}

}
