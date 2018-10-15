<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Copyright;
use Validator;
use Calendar;

class ScheduleController extends Controller
{
	protected $viewPath = 'admin.schedule.'; 

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function viewCalendar()
	{
		$events = Copyright::get();
		$event_list = [];
		foreach($events as $key => $event) {
			$event_list[] = Calendar::event(
				$event->str_project_title,
				true,
				new \DateTime($event->dtm_to_submit)
			);
		}
		$calendar_details = Calendar::addEvents($event_list);

		return view('admin.schedule.calendar', compact('calendar_details'));
	}

	public function listTodaySchedule()
	{
		$copyrights = Copyright::all();
		return view('admin.schedule.today', ['copyrights' => $copyrights]);
	}
}