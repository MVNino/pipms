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
        $patents = Patent::all();
        return view('admin.reports.list-patents', ['patents' => $patents]);
    }

    public function viewPatent($id)
    {
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.reports.view-patent', 
            ['patentCollection' => $patentCollection]);
    }
}
