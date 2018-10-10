<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
use App\Copyright;
use App\Patent;

class BranchController extends Controller
{
	public $viewPath;
    public $copyright;
    public $patent;
    public $column;
  
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->column = 'branches.str_branch_name';
        $this->middleware('auth');
    }

    public function listBranches()
    {
        $patentStats = $this->patent
            ->patentStats($this->column);
        $copyrightStats = $this->copyright
            ->copyrightStats($this->column);
    	return view($this->viewPath.'list-branches', 
            ['copyrightStats' => $copyrightStats, 
            'patentStats' => $patentStats]);
    }

    public function dateRangedBranches($startDate, $endDate)
    {
        $data = 'This is else';
        return redirect()->back()->with('data', $data);   
    }
}