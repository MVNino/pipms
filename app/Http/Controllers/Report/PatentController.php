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
    {
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

    public function rangedPatents(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $patents = $this->patent
            ->rangeAllRecords($dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-patents', 
            ['patents' => $patents, 'dateStart' => $dateStart, 
            'dateEnd' => $dateEnd]);
    }
}
