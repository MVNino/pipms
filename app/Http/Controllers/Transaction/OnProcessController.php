<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\WorkCopyrighted;
use App\Notifications\WorkCopyrightedDb;
use App\Copyright;
use App\Patent;
use App\User;

class OnProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    #COPYRIGHT
    public function listOnProcessCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'On process')
            ->get();
        return view('admin.transaction.copyright-on-process', 
            ['copyrights' => $copyrights]);  
    }

    public function viewOnProcessCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-on-process', 
            ['copyrightCollection' => $copyrightCollection]); 
    }

    public function changeStatusToCopyrighted(Request $request, $id)
    {
        // change status from 'on process' to 'copyrighted'
        $copyright = Copyright::findOrFail($id);
        $copyright->char_copyright_status = 'copyrighted';
        $copyright->dtm_copyrighted = now();
        $copyright->save();
        // Send email notification
        \Notification::route('mail', $copyright->applicant->user->email)
            ->notify(new WorkCopyrighted);
        User::findOrFail($copyright->applicant->user->id)->notify(new WorkCopyrightedDb);
        $promptMsg = "The work has been copyrighted!";
        return redirect('/admin/transaction/copyrights/on-process')
            ->with('success', $promptMsg);
    }

    # PATENT
    public function listOnProcessPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'On process')
            ->get();
        return view('admin.transaction.patent-on-process', ['patents' => $patents]);
    }


    public function viewOnProcessPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-on-process', 
            ['patentCollection' => $patentCollection]);
    }
}