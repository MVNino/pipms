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
    public $copyright;
    public $patent;
    public $status;
    public $viewPath;

    public function __construct()
    {
        $this->status = 'pending';
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->viewPath = 'admin.transaction.';
        $this->middleware('auth');
    }

    # COPYRIGHT
    public function listPendingCopyrightRequest()
    {
        // List copyright records
        $copyrights = $this->copyright
            ->whereStatusIs($this->status);

        // Group copyrights by college
        return $groupedCopyrights = $this->copyright
            ->groupByCollege($this->status);

        return view($this->viewPath.'copyright-pending', 
            ['copyrights' => $copyrights, 
            'groupedCopyrights' => $groupedCopyrights]);
    }

    public function viewPendingCopyrightRequest($id)
    {
        // Show specific copyright record
        $copyrightCollection = $this->copyright
            ->extractThisRecord($this->status, $id);

        return view($this->viewPath.'view-copyright-pending', 
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
        // List patent records
        $patents = $this->patent->listPatents($this->status);

        return view($this->viewPath.'patent-pending', 
            ['patents' => $patents]);
    }

    public function viewPendingPatentRequest($id)
    {  
        // Show specific patent record
        $patentCollection = $this->patent
            ->extractThisRecord($this->status, $id);

        return view($this->viewPath.'view-patent-pending', 
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