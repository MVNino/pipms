<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;

class BranchController extends Controller
{
	public $viewPath = 'admin.reports.';
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listBranches()
    {
        // $brachn
    	$branches = Branch::orderBy('int_id', 'asc')->get();
    	return view($this->viewPath.'list-branches', 
    		['branches' => $branches]);
    }
}