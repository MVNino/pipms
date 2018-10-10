<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Copyright;
use App\Event;
use Validator;
use Calendar;


class ScheduleController extends Controller
{
	protected $viewPath = 'admin.schedule.'; 

	public function viewCalendar()
	{
		$events = Event::get();
		$event_list = [];
		foreach($events as $key => $event) {
			$event_list[] = Calendar::event(
				$event->event_name,
				true,
				new \DateTime($event->start_date),
				new \DateTime($event->end_date.' +1 day')
			);
		}
		$calendar_details = Calendar::addEvents($event_list);

<<<<<<< HEAD
<<<<<<< HEAD
		return view('admin.schedule.calendar', compact('calendar_details'));
=======
		return view($this->viewPath, compact('caledar_details'));
>>>>>>> 53d7fbf679343f8db1712e41d70dc6b8e5a40fbe
=======
		return view('admin.schedule.calendar', compact('calendar_details'));

>>>>>>> b59b342e0f37a3bec23cb473e9d3221bca718be4
	}

	public function listTodaySchedule()
	{
		// extract today's IPR requests
		$current = Carbon::now()->format('Y-m-d');
		$copyrights = Copyright::with(['patent', 'applicant.department.college.branch'])
			->where('char_copyright_status', 'to submit')
			->where('dtm_schedule', 'LIKE', '%'.$current.'%')
			->orderBy('dtm_schedule')
			->get();
		return view($this->viewPath.'today', ['copyrights' => $copyrights]);
	}
}
