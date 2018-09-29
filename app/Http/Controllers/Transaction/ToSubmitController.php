<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class ToSubmitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    # COPYRIGHT
    public function listToSubmitCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'To submit')
            ->get();
        return view('admin.transaction.copyright-to-submit', 
        	['copyrights' => $copyrights]);
    }

    public function viewToSubmitCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-to-submit', 
            ['copyrightCollection' => $copyrightCollection]);
    }

    # PATENT
    public function listToSubmitPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'To submit')
            ->get();
        return view('admin.transaction.patent-to-submit', ['patents' => $patents]);
    }

    public function viewToSubmitPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-to-submit', 
            ['patentCollection' => $patentCollection]);
    }
}
