<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Patent;
use App\User;
use Carbon\Carbon;

class AuthorController extends Controller
{  
    public $author;  
    public function __construct()
    {
        $this->author = new User;
        $this->middleware('auth');
    }

	public function listApplicants()
	{
        $authors = $this->author->authorStats();
        return view('admin.reports.list-authors', 
            ['authors' => $authors]);
	}

	public function viewApplicant($id)
	{
        $applicantCollection = Applicant::with(['department.college.branch'], ['copyright.patent'])
            ->where('applicants.int_id', $id)
            ->get();           
        return view('admin.reports.view-author', 
            ['applicantCollection' => $applicantCollection]);
	}
}
