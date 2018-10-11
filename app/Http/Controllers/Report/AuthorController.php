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
    public $viewPath;
    public $author;  
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->author = new User;
        $this->middleware('auth');
    }

	public function listApplicants()
	{
        $authors = $this->author->authorStats();
        return view($this->viewPath.'list-authors', 
            ['authors' => $authors]);
	}

	public function viewApplicant($id)
	{
        $applicantCollection = Applicant::with(['department.college.branch'], 
            ['copyright.patent'])
            ->where('applicants.int_id', $id)
            ->get();           
        return view($this->viewPath.'view-author', 
            ['applicantCollection' => $applicantCollection]);
	}

    public function rangedAuthors(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $authors = $this->author->rangedAuthorStats($dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-authors', 
            ['authors' => $authors, 'dateStart' => $dateStart, 
            'dateEnd' => $dateEnd]);
    }
}
