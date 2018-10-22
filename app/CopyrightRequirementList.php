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
}
