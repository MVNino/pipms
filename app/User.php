<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    // Relationship of User to Copyright table
    public function copyrights()
    {
        return $this->hasMany('App\Copyright', 'int_user_id', 'id');
    }

    public function applicant()
    {
        return $this->hasOne('App\Applicant', 'int_user_id', 'id');
    }
}
