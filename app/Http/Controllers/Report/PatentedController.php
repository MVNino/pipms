<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class PatentedController extends Controller
{
    # Controller for Patented Reports
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listPatents()
    {
        $patents = Patent::where('char_patent_status', 'patented')
            ->get();
        return view('admin.reports.list-patented', ['patents' => $patents]);
    }

    public function viewPatent($id)
    {
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.reports.view-patented', 
            ['patentCollection' => $patentCollection]);
    }
}
