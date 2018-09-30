<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Notifications\AppointmentSet;
use App\Notifications\RequestOnProcess;
use App\Notifications\RequestOnProcessDb;
use App\Notifications\WorkCopyrighted;
use App\Notifications\WorkCopyrightedDb;
use App\Notifications\PatentRequestAppointmentSet;
use App\Notifications\PatentAppointmentSetDb;
use App\Notifications\PatentRequestOnProcess;
use App\Notifications\PatentOnProcessDb;
use App\Notifications\WorkPatented;
use App\Notifications\WorkPatentedDb;
use App\Notifications\AppointmentSetDb;
use App\Applicant;
use App\Copyright;
use App\Patent;
use App\User;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /*--------------------------------------|
	 *	Transaction module					|
	 *--------------------------------------|
    **/
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['requestInitialCopyrightForm']]);
    }

    public function random_code()
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
    }

    public function upStatus($id)
    {
        $copyright = Copyright::findOrFail($id);
        if ($copyright->char_copyright_status == 'pending') {
            $copyright->char_copyright_status = 'To submit';
            $promptMsg = "The record changed its status to 'To submit'. 
            An email notification has been sent to applicant.";
            $copyright->save();
            return redirect('/admin/transaction/copyrights/pend-request')->with('success', $promptMsg);
        } else if ($copyright->char_copyright_status == 'To submit') {
            $copyright->char_copyright_status = 'On process';
            $promptMsg = "Request in now on process to its copyright registration";
            $copyright->save();
            return redirect('/admin/transaction/copyrights/to-submit')->with('success', $promptMsg);
        } else if ($copyright->char_copyright_status == 'On process') {
            $copyright->char_copyright_status = 'Copyrighted';
            $promptMsg = "Request in now copyrighted";
            $copyright->save();
            return redirect('/admin/transaction/copyrights/on-process')->with('success', $promptMsg);
        }
    }

    public function setSchedule(Request $request, $id)
    {
        $this->validate($request, [
            'dateSchedule' => 'required',
            'timeSchedule' => 'required'
        ]);

        // return $request->timeSchedule;
        // return Carbon::createFromFormat()
        // return $date = $request->dateSchedule.' '.$request->timeSchedule;
        // $time = $request->timeSchedule;
        $schedule = Carbon::createFromFormat('Y-m-d H:i', 
            $request->dateSchedule.' '.$request->timeSchedule)
            ->toDateTimeString();
        $copyright = Copyright::findOrFail($id);
        $copyright->dtm_schedule = $schedule;
        $copyright->char_copyright_status = 'To submit';
        $copyright->save();
        $promptMsg = 'Appointment set! The record changed its status to "To submit". 
            An email notification has been sent to applicant.';
        \Notification::route('mail', $copyright->applicant->user->email)
            ->notify(new AppointmentSet($schedule));
        $userId = $copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new AppointmentSetDb($schedule));
        return redirect('admin/transaction/copyrights/pend-request')
            ->with('success', $promptMsg);
    }

    public function changeStatusToOnProcess($id)
    {
        // change status from 'to submit' to 'on process'
        $copyright = Copyright::findOrFail($id);
        $copyright->char_copyright_status = 'On process';
        $copyright->save();
        // send email
        \Notification::route('mail', $copyright->applicant->user->email)
            ->notify(new RequestOnProcess);
        $userId = $copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new RequestOnProcessDb);
        $promptMsg = "Request in now on process to its copyright registration";
        return redirect('/admin/transaction/copyrights/to-submit')
            ->with('success', $promptMsg);
    }

    public function changeStatusToCopyrighted($id)
    {
        // change status from 'on process' to 'copyrighted'
        $copyright = Copyright::findOrFail($id);
        $copyright->char_copyright_status = 'Copyrighted';
        $copyright->save();

        // Send email notification
        \Notification::route('mail', $copyright->applicant->str_email_address)
            ->notify(new WorkCopyrighted);
        User::findOrFail($copyright->applicant->user->id)->notify(new WorkCopyrightedDb);
        return redirect('/admin/transaction/copyrights/on-process');
    }
   
    public function setScheduleForPatent(Request $request, $id)
    {
        $this->validate($request, [
            'dateSchedule' => 'required',
            'timeSchedule' => 'required'
        ]);

        $schedule = Carbon::createFromFormat('d-m-Y H:i', $request->dateSchedule.' '.$request->timeSchedule)->toDateTimeString();
        $patent = Patent::findOrFail($id);
        $patent->dtm_schedule = $schedule;
        $patent->char_patent_status = 'To submit';
        $patent->save();
        $promptMsg = 'Appointment set! The patent request record changed its status to "To submit". 
            An email notification has been sent to the author.';
        \Notification::route('mail', $patent->copyright->applicant->user->email)
            ->notify(new PatentRequestAppointmentSet($schedule));
        $userId = $patent->copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new PatentAppointmentSetDb($schedule));     
        return redirect('admin/transaction/patents/pend-request')->with('success', $promptMsg);
    }
    public function changePatentStatusToOnProcess($id)
    {
        // change status from 'to submit' to 'on process'
        $patent = Patent::findOrFail($id);
        $patent->char_patent_status = 'On process';
        $patent->save();
        // send email
        \Notification::route('mail', $patent->copyright->applicant->user->email)
            ->notify(new PatentRequestOnProcess);
        $userId = $patent->copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new PatentOnProcessDb);  
        $promptMsg = "Request in now on process to its copyright registration";
        return redirect('/admin/transaction/patents/to-submit')->with('success', $promptMsg);
    }

    public function changePatentStatusToPatented($id)
    {
        // change status from 'on process' to 'copyrighted'
        $patent = Patent::findOrFail($id);
        $patent->char_patent_status = 'Patented';
        $patent->save();

        // Send email notification
        \Notification::route('mail', $patent->copyright->applicant->user->email)
            ->notify(new WorkPatented);
        $userId = $patent->copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new WorkPatentedDb); 
        return redirect('/admin/transaction/patents/on-process');
    }

    // C-R-M
    public function listInitialRequests()
    {
        $applicants = Applicant::where('str_application_token', NULL)->get();
        return view('admin.transaction.copyright-initial-request', 
            ['applicants' => $applicants]);
    }

}
