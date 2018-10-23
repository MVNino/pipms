<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class ApplicationIssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listApplicationIssues()
    {
    	$copyrights = Copyright::where('char_copyright_status', 'conflict')
    		->orWhere('char_copyright_status', 'to submit/conflict')
    		->get();
    	$patents = Patent::where('char_patent_status', 'conflict')
    		->orWhere('char_patent_status', 'to submit/conflict')
    		->get();

    	return view('admin.reports.application-issues', 
    		['copyrights' => $copyrights, 'patents' => $patents]);
    }
}
