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
        'name', 'email', 'password',
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
    public function copyrights(){
        return $this->hasMany('App\Copyright', 'int_user_id', 'int_id');
    }

    public function applicants()
    {
        return $this->hasManyThrough(
            'App\Applicant',
            'App\Copyright',
            'int_user_id',
            'int_applicant_id',
            'int_id',
            'int_id'
        );
    }
}
