<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorAccountRequest extends Model
{
    // Table
	protected $table = 'author_account_requests';
    //Primary Key
	protected $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = true;

	public function applicant()
	{
		return $this->belongsTo('App\Applicant', 'int_applicant_id', 'int_id');
	}
}
