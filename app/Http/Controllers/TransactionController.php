<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Notifications\PatentRequestAppointmentSet;
use App\Notifications\PatentAppointmentSetDb;
use App\Notifications\PatentRequestOnProcess;
use App\Notifications\PatentOnProcessDb;
use App\Notifications\WorkPatented;
use App\Notifications\WorkPatentedDb;
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
}