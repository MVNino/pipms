<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\College;
use App\Copyright;
use App\Department;
use App\Project;
use App\ProjectType;
use App\User;

class GuestController extends Controller
{

    public function _construct()
    {
    	//
    }

    // Index page
    public function index()
    {	
        // $userNum = User::count();
        if(!auth()->guest()) {
            return redirect('/admin/dashboard');
        }
        // if($userNum == 0){
        //     return redirect('/admin/registration');
        // }
    	$title = 'PUP-Intellectual Property Management System';
    	return view('guest.index')->with('title', $title);
    }

    // About Page
    public function about()
    {
        // $userNum = User::count();
        // if($userNum == 0){
        //     return redirect('/admin/registration');
        // } else{
        //     return view('guest.about');   
        // }
        return view('guest.about');  
    }
 
}