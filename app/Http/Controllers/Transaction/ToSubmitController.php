<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Notifications\RequestOnProcess;
use App\Notifications\RequestOnProcessDb;
use App\Copyright;
use App\Patent;
use Carbon\Carbon;

class ToSubmitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    # COPYRIGHT
    public function listToSubmitCopyrightRequest()
    { 
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'To submit')
            ->where('dtm_schedule', '!=', null)
            ->orderBy('dtm_schedule')
            ->get();
        return view('admin.transaction.copyright-to-submit', 
        	['copyrights' => $copyrights]);
    }

    public function viewToSubmitCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-to-submit', 
            ['copyrightCollection' => $copyrightCollection]);
    }

    public function changeStatusToOnProcess(Request $request, $id)
    {
        // change status from 'to submit' to 'on process'
        $copyright = Copyright::findOrFail($id);
        $copyright->char_copyright_status = 'on process';
        $copyright->dtm_on_process = now();
        $copyright->save();
        // send email
        // \Notification::route('mail', $copyright->applicant->user->email)
        //     ->notify(new RequestOnProcess);
        $userId = $copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new RequestOnProcessDb);
        $promptMsg = "Request in now on process to its copyright registration";
        return redirect('/admin/transaction/copyrights/to-submit')
            ->with('success', $promptMsg);
    }

    # PATENT
    public function listToSubmitPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'To submit')
            ->where('dtm_schedule', '!=', null)
            ->orderBy('dtm_schedule')
            ->get();
        return view('admin.transaction.patent-to-submit', ['patents' => $patents]);
    }

    public function viewToSubmitPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-to-submit', 
            ['patentCollection' => $patentCollection]);
    }
}
