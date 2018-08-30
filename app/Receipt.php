<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    // Table
	protected $table = 'receipts';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;

	public function applicant()
	{
		return $this->belongsTo('App\Applicant', 'int_applicant_id', 'int_id');
	}

	public function copyright()
	{
		return $this->belongsTo('App\Copyright', 'int_copyright_id', 'int_id');
	}
}
