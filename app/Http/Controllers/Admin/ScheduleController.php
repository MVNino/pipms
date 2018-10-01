<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Copyright;

class ScheduleController extends Controller
{
	protected $viewPath = 'admin.schedule.';

	public function viewCalendar()
	{
		return view($this->viewPath.'calendar');
	}

	public function listTodaySchedule()
	{
		// extract today's IPR requests
		$current = Carbon::now()->format('Y-m-d');
		$copyrights = Copyright::with('applicant.department.college.branch')
			->where('dtm_schedule', 'LIKE', '%'.$current.'%')
			->orderBy('dtm_schedule')
			->get();
		return view('admin.schedule.today', ['copyrights' => $copyrights]);
	}

	public function listScheduleConflicts()
	{
		return view($this->viewPath.'conflicts');	
	}
}
