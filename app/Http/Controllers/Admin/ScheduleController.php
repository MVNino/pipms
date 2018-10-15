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
		// return copyrights TODAY and !PENDING!
		$copyrightsToday = Copyright::where('dtm_schedule', 'LIKE', '%'.Carbon::now()->format('Y-m').'%')
			->where('char_copyright_status', '!=', 'pending')->get();
		$copyrights = Copyright::where('char_copyright_status', 'to submit')->get();
		return view('admin.schedule.today', ['copyrights' => $copyrights, 
			'copyrightsToday' => $copyrightsToday]);
	}

	public function classifyToConflicts(Request $request, $id)
	{
		$copyright = Copyright::findOrFail($id);
		$copyright->char_copyright_status = 'conflict';
		if($copyright->save()) {
			return redirect()->back();
		}
	}

	public function getClassifyToConflicts($id)
	{
		$copyright = Copyright::findOrFail($id);
		$copyright->char_copyright_status = 'conflict';
		if($copyright->save()) {
			return redirect()->back()->with('success', 'This request was being added to appointment conflict.');
		}
	}
}