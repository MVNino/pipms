<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
<<<<<<< HEAD
    public function myProjects()
    {
    
        $myProjects = auth()->user()->applicant->copyrights;
        return view('author-pd.my-projects', ['myProjects' => $myProjects]);
       
=======
    public function viewMyProjects()
    {    
        return $myProjects = auth()->user()->applicant->copyrights;
        return view('author-pd.my-projects');
>>>>>>> ad943617265c828b39ff1db893ef0e1264e041ce
    }

    public function viewMyProject($id)
    {
    	return view('author-pd.view-my-project');
    }


}
