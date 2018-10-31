<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatentRequirementList extends Model
{
    // Table
	protected $table = 'patent_requirement_lists';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = false;

	public function patent()
	{
		return $this->belongsTo('App\Patent', 'int_patent_id', 'int_id');
	}

	public function requirement()
	{
		return $this->belongsTo('App\Requirement', 'int_requirement_id', 'int_id');
	}
}
