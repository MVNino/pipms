<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SetAppointmentCloned;
use App\Notifications\AppointmentSet;
use App\Notifications\AppointmentSetDb;
use App\Notifications\PatentRequestAppointmentSet;
use App\Notifications\PatentAppointmentSetDb;
use App\Copyright;
use App\Patent;
use App\Project;
use App\ProjectType;
use App\User;
use Carbon\Carbon;

class PendRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    # COPYRIGHT
    public function listPendingCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'LIKE', '%pending%')
            ->get();
        return view('admin.transaction.copyright-pending', 
            ['copyrights' => $copyrights]);
    }

    public function viewPendingCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'LIKE', '%pending%')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-pending', 
            ['copyrightCollection' => $copyrightCollection]);
    }


    public function setSchedule(Request $request, $id)
    {
        $this->validate($request, [
            'dateSchedule' => 'required',
            'timeSchedule' => 'required'
        ]);
        $schedule = Carbon::createFromFormat('Y-m-d H:i', 
            $request->dateSchedule.' '.$request->timeSchedule)
            ->toDateTimeString();
        $copyright = Copyright::findOrFail($id);
        $copyright->dtm_schedule = $schedule;
        $copyright->dtm_to_submit = $schedule;
        $copyright->char_copyright_status = 'to submit';
        $copyright->save();
        $promptMsg = 'Appointment set! The record changed its status to "to submit". 
            An email notification has been sent to applicant.';
        \Notification::route('mail', $copyright->applicant->user->email)
            ->notify(new AppointmentSet($schedule));
        $userId = $copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new AppointmentSetDb($schedule));
        return redirect('admin/transaction/copyrights/pend-request')
            ->with('success', $promptMsg);
    }

    # PATENT
    public function listPendingPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'LIKE', '%pending%')
            ->get();
        return view('admin.transaction.patent-pending', ['patents' => $patents]);
    }

    public function viewPendingPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'LIKE', '%pending%')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-pending', 
            ['patentCollection' => $patentCollection]);
    }
 
    public function setScheduleForPatent(Request $request, $id)
    {
        $this->validate($request, [
            'dateSchedule' => 'required',
            'timeSchedule' => 'required'
        ]);

        $schedule = Carbon::createFromFormat('Y-m-d H:i', 
            $request->dateSchedule.' '.$request->timeSchedule)
            ->toDateTimeString();
        $patent = Patent::findOrFail($id);
        $patent->dtm_schedule = $schedule;
        $patent->dtm_to_submit = $schedule;
        $patent->char_patent_status = 'to submit';
        if($patent->save()) {
            $promptMsg = 'Appointment set! The patent request record changed its status to "to submit". 
                An email notification has been sent to the author.';
            \Notification::route('mail', $patent->copyright->applicant->user->email)
                ->notify(new PatentRequestAppointmentSet($schedule));
            $userId = $patent->copyright->applicant->user->id;
            User::findOrFail($userId)->notify(new PatentAppointmentSetDb($schedule));     
            return redirect(route('transaction.patent-pending'))->with('success', $promptMsg);
        }
    }

    public function cloneCopyrightAppointment(Request $request, $id)
    {
        $patent = Patent::findOrFail($id);
        $patent->dtm_schedule = $patent->copyright->dtm_schedule;
        $patent->dtm_to_submit = $patent->copyright->dtm_schedule;
        $patent->char_patent_status = 'to submit';
        if ($patent->save()) {
            $userId = $patent->copyright->applicant->user->id;
            User::findOrFail($userId)->notify(new SetAppointmentCloned);
            $promptMsg = "Project's patent appointment was 
                also set to its relative copyright appointment. Status had 
                changed to 'to submit'";       
            return redirect(route('transaction.patent-pending'))
                ->with('success', $promptMsg);
        }
    }
}
