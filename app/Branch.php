<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    // Table
	protected $table = 'branches';
    //Primary Key
	protected $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;

	public function colleges()
	{
		return $this->hasMany('App\College', 'int_branch_id', 'int_id');
	}

	public function departments()
	{
		return $this->hasManyThrough(
			'App\Department', 	// target model
			'App\College',		// intermediate model
			'int_branch_id',	// FK of intermediate model
			'int_college_id',	// FK of target model
			'int_id',			// local id of $this model
			'int_id'			// local id of intermediate model
		);
	}
}
