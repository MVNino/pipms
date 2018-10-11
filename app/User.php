<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'str_first_name', 
        'str_middle_name', 
        'str_last_name',
        'str_username', 
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Relationship of User to Copyright table
    public function copyrights()
    {
        return $this->hasMany('App\Copyright', 'int_user_id', 'id');
    }

    public function applicant()
    {
        return $this->hasOne('App\Applicant', 'int_user_id', 'id');
    }

    // User(Author) Statistics
    public function authorStats()
    {
        return DB::table('users')
            ->join('applicants', 'users.id', '=', 'applicants.int_user_id')
            ->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
            ->join('patents', 'copyrights.int_id', '=', 'patents.int_copyright_id')
            ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select(DB::raw('users.str_first_name, users.str_middle_name, 
                users.str_last_name, applicants.dtm_birthdate, 
                applicants.char_gender, applicants.char_applicant_type, 
                count(copyrights.int_id) as copyright_count, 
                count(case when patents.int_id then 1 else null end) 
                as patent_count, users.created_at, char_department_code, 
                char_college_code, str_branch_name, copyrights.str_project_title, 
                patents.str_patent_project_title'))
            ->where('users.isAdmin', 0)
            ->groupBy('users.id')
            ->get();
    }

    // Ranged User(Author) Statistics
    public function rangedAuthorStats($start, $end)
    {
        return DB::table('users')
            ->join('applicants', 'users.id', '=', 'applicants.int_user_id')
            ->join('copyrights', 'applicants.int_id', '=', 'copyrights.int_applicant_id')
            ->join('patents', 'copyrights.int_id', '=', 'patents.int_copyright_id')
            ->join('departments', 'applicants.int_department_id', '=', 'departments.int_id')
            ->join('colleges', 'departments.int_college_id', '=', 'colleges.int_id')
            ->join('branches', 'colleges.int_branch_id', '=', 'branches.int_id')
            ->select(DB::raw('users.str_first_name, users.str_middle_name, 
                users.str_last_name, applicants.dtm_birthdate, 
                applicants.char_gender, applicants.char_applicant_type, 
                count(copyrights.int_id) as copyright_count, 
                count(case when patents.int_id then 1 else null end) 
                as patent_count, users.created_at, char_department_code, 
                char_college_code, str_branch_name, copyrights.str_project_title, 
                patents.str_patent_project_title'))
            ->whereBetween('users.created_at', [$start, $end])
            ->where('users.isAdmin', 0)
            ->groupBy('users.id')
            ->get();
    }
}
