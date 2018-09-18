<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    // Table
	protected $table = 'requirements';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;
}
