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
}
