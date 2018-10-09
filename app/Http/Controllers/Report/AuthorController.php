<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Patent;

class AuthorController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function listApplicants()
	{
        $applicants = Applicant::with(['department.college.branch'], ['copyright.patent'], ['user'])
            ->get();      
        return view('admin.reports.list-authors', 
            ['applicants' => $applicants]);
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
