<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ReappointmentSet;
use App\Notifications\ReappointmentSetDb;
use App\Notifications\RequestOnProcess;
use App\Notifications\RequestOnProcessDb;
use App\Notifications\PatentRequestOnProcess;
use App\Notifications\PatentOnProcessDb;
use App\Copyright;
use App\CopyrightRequirementList;
use App\Patent;
use App\Requirement;
use App\User;
use Carbon\Carbon;

class ToSubmitController extends Controller
{
    public $copyright;
    public $patent;
    public $status;
    public $viewPath;

    public function __construct()
    {
        $this->status = 'to submit';
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->viewPath = 'admin.transaction.';
        $this->middleware('auth');
    }

    # COPYRIGHT
    public function listToSubmitCopyrightRequest()
    { 
        $copyrights = $this->copyright
            ->toSubmit($this->status);
        return view($this->viewPath.'copyright-to-submit', 
        	['copyrights' => $copyrights]);
    }

    public function viewToSubmitCopyrightRequest($id)
    {
        $dateNow = Carbon::now()->format('Y-m-d');
        $copyright = Copyright::findOrFail($id);
        if($copyright->char_copyright_status == 'to submit/conflict' AND $copyright->dtm_schedule->format('Y-m-d') == $dateNow) {
            $copyrightCollection = $this->copyright
                ->viewToSubmitConflict($id);
        } else {
            $copyrightCollection = $this->copyright
                ->viewToSubmit($this->status, $id);
        }
        $requirements = Requirement::where('char_ipr', 'C')->get();

        return view($this->viewPath.'view-copyright-to-submit', 
            ['copyrightCollection' => $copyrightCollection, 
            'requirements' => $requirements]);
    }

    public function incompleteRequirements(Request $request)
    {
        $this->validate($request, [
            'dateSchedule' => 'required',
            'timeSchedule' => 'required'
        ]);
        if ($request->checkRequirement_1) {
            $reqList1 = new CopyrightRequirementList;
            $reqList1->int_requirement_id = 1;
            $reqList1->int_copyright_id = $request->copyrightId;
            $reqList1->save();
        }
        if ($request->checkRequirement_2) {
            $reqList2 = new CopyrightRequirementList;
            $reqList2->int_requirement_id = 2;
            $reqList2->int_copyright_id = $request->copyrightId;
            $reqList2->save();
        }
        // walang 3, sa patent un
        if ($request->checkRequirement_4) {
            $reqList4 = new CopyrightRequirementList;
            $reqList4->int_requirement_id = 4;
            $reqList4->int_copyright_id = $request->copyrightId;
            $reqList4->save();
        }
        if ($request->checkRequirement_5) {
            $reqList5 = new CopyrightRequirementList;
            $reqList5->int_requirement_id = 5;
            $reqList5->int_copyright_id = $request->copyrightId;
            $reqList5->save();
        }
        if ($request->checkRequirement_6) {
            $reqList6 = new CopyrightRequirementList;
            $reqList6->int_requirement_id = 6;
            $reqList6->int_copyright_id = $request->copyrightId;
            $reqList6->save();
        }
        if ($request->checkRequirement_7) {
            $reqList7 = new CopyrightRequirementList;
            $reqList7->int_requirement_id = 7;
            $reqList7->int_copyright_id = $request->copyrightId;
            $reqList7->save();
        }
        if ($request->checkRequirement_8) {
            $reqList8 = new CopyrightRequirementList;
            $reqList8->int_requirement_id = 8;
            $reqList8->int_copyright_id = $request->copyrightId;
            $reqList8->save();
        }

        // Set the schedule now
        $schedule = Carbon::createFromFormat('Y-m-d H:i', 
            $request->dateSchedule.' '.$request->timeSchedule)
            ->toDateTimeString();
        $copyright = Copyright::findOrFail($request->copyrightId);
        $copyright->dtm_schedule = $schedule;
        $copyright->char_copyright_status = 'to submit/conflict';
        $copyright->save();
        $promptMsg = 'Re-appointment set! Details in regards to incomplete requirements 
            has been sent to the applicant.';
        $userId = $copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new ReappointmentSetDb($schedule));
        
        \Notification::route('mail', $copyright->applicant->user->email)
            ->notify(new ReappointmentSet($schedule));
        return redirect('admin/schedule-today')
            ->with('success', $promptMsg);
    }

    public function changeStatusToOnProcess(Request $request, $id)
    {
        // change status from 'to submit' to 'on process'
        $copyright = Copyright::findOrFail($id);
        $copyright->char_copyright_status = 'on process';
        $copyright->dtm_on_process = now();
        $copyright->save();
        // send email
        \Notification::route('mail', $copyright->applicant->user->email)
            ->notify(new RequestOnProcess);
        $userId = $copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new RequestOnProcessDb);
        $promptMsg = "Request in now on process to its copyright registration";
        return redirect(route('transaction.copyright-to-submit'))
            ->with('success', $promptMsg);
    }

    # PATENT
    public function listToSubmitPatentRequest()
    {
        $patents = $this->patent
            ->toSubmit($this->status);
        return view($this->viewPath.'patent-to-submit', ['patents' => $patents]);
    }

    public function viewToSubmitPatentRequest($id)
    {  
        $patentCollection = $this->patent
            ->viewToSubmit($this->status, $id);

        $requirements = Requirement::where('char_ipr', 'P')->get();

        return view($this->viewPath.'view-patent-to-submit', 
            ['patentCollection' => $patentCollection, 
            'requirements' => $requirements]);
    }

    public function changePatentStatusToOnProcess($id)
    {
        // change status from 'to submit' to 'on process'
        $patent = Patent::findOrFail($id);
        $patent->char_patent_status = 'on process';
        $patent->dtm_on_process = now();
        if($patent->save()) {
            // send email
            \Notification::route('mail', $patent->copyright->applicant->user->email)
                ->notify(new PatentRequestOnProcess);
            $userId = $patent->copyright->applicant->user->id;
            User::findOrFail($userId)->notify(new PatentOnProcessDb);  
            $promptMsg = "Request in now on process to its copyright registration";
            return redirect(route('transaction.patent-to-submit'))
                ->with('success', $promptMsg);
        }
    }

}
