<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Copyright;

class ScheduleIssueController extends Controller
{
	# Reports for schedule issues
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function listScheduleIssues()
	{
		return view('admin.reports.schedule-issues');	
	}
}
