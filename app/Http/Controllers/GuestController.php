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
        $userNum = User::count();
        if(!auth()->guest()) {
            $isAdmin = auth()->user()->isAdmin;
            if ($isAdmin === 0) {
                return redirect('/author/'.auth()->user()->id.'/dashboard');
            } else {
                return redirect('/admin/dashboard');   
            }
        }
        if($userNum == 0){
            return redirect('/register');
        }
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
         return view('guest.about-us');   
        // }
    }

    public function viewApplicationGuide()
    {
        // $userNum = User::count();
        // if($userNum == 0){
        //     return redirect('/admin/registration');
        // } else{
            return view('guest.application-guide');  
        // }
    } 

    public function loginAdmin()
    {
        return view('guest.login-admin');
    }

    public function loginAuthor()
    {
        return view('guest.login-author');
    }
}