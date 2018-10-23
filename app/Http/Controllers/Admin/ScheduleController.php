<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Copyright;
use App\Patent;
use Validator;
use Calendar;
use DB;

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
		// return copyrights TODAY
		$dateNow = Carbon::now()->format('Y-m-d');
		$copyrights = Copyright::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
            ->where(function ($query) { 
                $query->where('char_copyright_status', 'to submit') 
                      ->orWhere('char_copyright_status', 'to submit/conflict'); 
            })
			->orderBy('dtm_schedule')
			->get();
		$copyToProcessCount = Copyright::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
	            ->where(function ($query) { 
	                $query->where('char_copyright_status', 'to submit') 
	                      ->orWhere('char_copyright_status', 'to submit/conflict'); 
	            })
				->get()
				->count();
		$copySuccessCount = Copyright::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
	            ->where(function ($query) { 
	                $query->where('char_copyright_status', 'on process') 
	                      ->orWhere('char_copyright_status', 'copyrighted'); 
	            })
				->get()
				->count();
		$copyConflictCount = Copyright::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
	            ->where('char_copyright_status', 'conflict')
				->get()
				->count();
		$copyTotalCount = $copyToProcessCount + $copySuccessCount + $copyConflictCount;
		// Patents
		$patents = Patent::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
            ->where(function ($query) { 
                $query->where('char_patent_status', 'to submit') 
                      ->orWhere('char_patent_status', 'to submit/conflict'); 
            })
			->orderBy('dtm_schedule')
			->get();
		$ptntToProcessCount = Patent::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
	            ->where(function ($query) { 
	                $query->where('char_patent_status', 'to submit') 
	                      ->orWhere('char_patent_status', 'to submit/conflict'); 
	            })
				->get()
				->count();
		$ptntSuccessCount = Patent::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
	            ->where(function ($query) { 
	                $query->where('char_patent_status', 'on process') 
	                      ->orWhere('char_patent_status', 'copyrighted'); 
	            })
				->get()
				->count();
		$ptntConflictCount = Patent::where('dtm_schedule', 'LIKE', '%'.$dateNow.'%') 
	            ->where('char_patent_status', 'conflict')
				->get()
				->count();
		$ptntTotalCount = $ptntToProcessCount + $ptntSuccessCount + $ptntConflictCount;
		return view('admin.schedule.today', ['copyrights' => $copyrights, 
			'patents' => $patents, 'copyToProcessCount' => $copyToProcessCount, 
			'copySuccessCount' => $copySuccessCount, 'copyConflictCount' => $copyConflictCount,
			'copyTotalCount' => $copyTotalCount, 'ptntToProcessCount' => $ptntToProcessCount, 
			'ptntSuccessCount' => $ptntSuccessCount, 'ptntConflictCount' => $ptntConflictCount, 
			'ptntTotalCount' => $ptntTotalCount]);
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