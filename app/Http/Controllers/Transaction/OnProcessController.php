<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\WorkCopyrighted;
use App\Notifications\WorkCopyrightedDb;
use App\Notifications\WorkPatented;
use App\Notifications\WorkPatentedDb;
use App\Copyright;
use App\Patent;
use App\User;

class OnProcessController extends Controller
{
    public $copyright;
    public $patent;
    public $status;
    public $viewPath;

    public function __construct()
    {
        $this->status = 'on process';
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->viewPath = 'admin.transaction.';
        $this->middleware('auth');
    }

    #COPYRIGHT
    public function listOnProcessCopyrightRequest()
    {
        // List copyright records
        $copyrights = $this->copyright
            ->whereStatusIs($this->status);

        return view('admin.transaction.copyright-on-process', 
            ['copyrights' => $copyrights]);  
    }

    public function viewOnProcessCopyrightRequest($id)
    {
        // Show specific copyright record
        $copyrightCollection = $this->copyright
            ->extractThisRecord($this->status, $id);
            
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
        return redirect(route('transaction.copyright-on-process'));
    }

    # PATENT
    public function listOnProcessPatentRequest()
    {
        // List patent records
        $patents = $this->patent->listPatents($this->status);

        return view('admin.transaction.patent-on-process', ['patents' => $patents]);
    }

    public function viewOnProcessPatentRequest($id)
    {  
        // Show specific patent record
        $patentCollection = $this->patent
            ->extractThisRecord($this->status, $id);
            
        return view('admin.transaction.view-patent-on-process', 
            ['patentCollection' => $patentCollection]);
    }

    public function changeStatusToPatented(Request $request, $id)
    {
        // change status from 'on process' to 'patent'
        $patent = Patent::findOrFail($id);
        $patent->char_patent_status = 'patented';
        $patent->dtm_patented = now();
        if($patent->save()) {
            // Send email notification
            \Notification::route('mail', $patent->copyright->applicant->user->email)
                ->notify(new WorkPatented);
            $userId = $patent->copyright->applicant->user->id;
            User::findOrFail($userId)->notify(new WorkPatentedDb); 
            return redirect(route('transaction.patent-on-process'));
        }
    }
}