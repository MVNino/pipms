<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CopyrightRequirementList extends Model
{
    // Table
	protected $table = 'copyright_requirement_lists';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = false;

	public function copyright()
	{
		return $this->belongsTo('App\Copyright', 'int_copyright_id', 'int_id');
	}

	public function requirement()
	{
		return $this->belongsTo('App\Requirement', 'int_requirement_id', 'int_id');
	}
}
