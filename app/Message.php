<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Table
	protected $table = 'messages';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;
}
