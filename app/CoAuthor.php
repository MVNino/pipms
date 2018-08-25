<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoAuthor extends Model
{
    // Table
	protected $table = 'co_authors';
    //Primary Key
	public $primaryKey = 'int_id';
    // Timestamps
	public $timestamps = false;

    protected $fillable = ['int_applicant_id', 'str_first_name', 'str_middle_name', 'str_last_name'];

    public function applicant()
    {
        return $this->belongsTo('App\Applicant', 'int_applicant_id', 'int_id');
    }

}
