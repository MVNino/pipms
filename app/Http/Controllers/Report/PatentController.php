<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class PatentController extends Controller
{
    public $viewPath;
    public $patent;
    # Controller for Patented Reports
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->patent = new Patent;
        $this->middleware('auth');
    }
    public function listPatents()
    
        $patents = $this->patent->allRecords();
        return view('admin.reports.list-patent', ['patents' => $patents]);
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
