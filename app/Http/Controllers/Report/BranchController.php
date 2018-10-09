<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
	public $viewPath = 'admin.reports.';
  
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }

	    public function listBranches()
	    {
	    	return view($this->viewPath.'list-branches');
	    }
}