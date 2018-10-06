<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class CopyrightedController extends Controller
{
    # Controller for Copyright records
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listCopyrights()
    {
        $copyrights = Copyright::where('char_copyright_status', 'copyrighted')->get();
        return view('admin.reports.list-copyrighted', 
        	['copyrights' => $copyrights]);
    }

    public function viewCopyright($id)
    {   
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'copyrighted')
            ->where('dtm_copyrighted', '!=', NULL)
            ->where('int_id', $id)
            ->get();

        return view('admin.reports.view-copyrighted', 
            ['copyrightCollection' => $copyrightCollection]);
    }
}