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
    // Index page
    public function index()
    {	
        $userNum = User::count();
        if(!auth()->guest()) {
            $isAdmin = auth()->user()->isAdmin;
            if ($isAdmin === 0) {
                return redirect('/dashboard');
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

    public function listCopyrightables()
    {
        // Extract works that is copyrightables
        $copyrightables = ProjectType::where('char_classification', 'C')
            ->orderBy('char_project_type')
            ->get();
        return view('guest.copyrightables', 
            ['copyrightables' => $copyrightables]);
    }

    public function listPatentables()
    {
        // Extract works that is copyrightables
        $patentables = ProjectType::where('char_classification', 'P')
            ->orderBy('char_project_type')
            ->get();
        return view('guest.patentables', 
            ['patentables' => $patentables]);
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