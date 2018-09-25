<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function myProjects()
    {
    
        $myProjects = auth()->user()->applicant->copyrights;
        return view('author-pd.my-projects', ['myProjects' => $myProjects]);
       
    }

    public function viewMyProject($id)
    {
        $myProject = Copyright::findOrFail($id);
        $myPatentProjects = Patent::findOrFail($id);
    	return view('author-pd.view-my-project', ['myProject' => $myProject, 'myPatentProjects' => $myPatentProjects]);
    }

   
   


}
