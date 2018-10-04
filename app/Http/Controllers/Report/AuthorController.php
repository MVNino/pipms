<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Patent;

class AuthorController extends Controller
{
	public function listApplicants()
	{
        $applicants = Applicant::all();        
        return view('admin.reports.list-applicants', 
            ['applicants' => $applicants]);
	}

	public function viewApplicant($id)
	{
        $applicantCollection = Applicant::with(['department.college.branch'], ['copyright.patent'])
            ->where('applicants.int_id', $id)
            ->get();           
        return view('admin.reports.view-applicant', 
            ['applicantCollection' => $applicantCollection]);
	}
}
