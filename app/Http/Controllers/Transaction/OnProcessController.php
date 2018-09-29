<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class OnProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    #COPYRIGHT
    public function listOnProcessCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'On process')
            ->get();
        return view('admin.transaction.copyright-on-process', ['copyrights' => $copyrights]);  
    }

    public function viewOnProcessCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-on-process', 
            ['copyrightCollection' => $copyrightCollection]); 
    }

    # PATENT
    public function listOnProcessPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'On process')
            ->get();
        return view('admin.transaction.patent-on-process', ['patents' => $patents]);
    }


    public function viewOnProcessPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-on-process', 
            ['patentCollection' => $patentCollection]);
    }
}