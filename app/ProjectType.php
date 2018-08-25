<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    // Table
	protected $table = 'project_types';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = false;

	public function projects()
	{
		return $this->hasMany('App\Project', 'int_project_type_id', 'int_id');
	}

	public function copyrights()
	{
		return $this->hasMany('App\Copyright', 'int_project_type_id', 'int_id');
	}

	public function patents()
	{
		return $this->hasMany('App\Patent', 'int_project_type_id', 'int_id');
	}
}
