<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function countCoAuthors($unit, $unitId)
    {
        return $this->join('applicants', 'co_authors.int_applicant_id', '=', 'applicants.int_id')
            ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select(DB::raw('count(co_authors.int_id) as co_author_count'))
            ->where($unit, $unitId)
            ->get();
    }
}
