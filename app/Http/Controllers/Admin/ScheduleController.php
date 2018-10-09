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

		return view('admin.schedule.calendar', compact('calendar_details'));

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
