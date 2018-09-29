<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SetAppointmentCloned;
use App\Copyright;
use App\Patent;
use App\Project;
use App\ProjectType;

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
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-pending', 
            ['copyrightCollection' => $copyrightCollection]);
    }

	public function viewCopyrightApplication()
	{
        $projects = Project::all();
        $projectTypes = ProjectType::all();  
		return view('author.copyright-application', 
			['projects' => $projects, 'projectTypes' => $projectTypes]);
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
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-pending', 
            ['patentCollection' => $patentCollection]);
    }
    
    public function viewPatentApplication()
    {
        // For creating/submission of patent related informations & file
        $maxCopyrightId = Copyright::max('int_id');
        $projects = Project::all();
        $projectTypes = ProjectType::all();
        return view('author.patent-application', ['projects' => $projects, 
            'projectTypes' => $projectTypes, 'maxCopyrightId' => $maxCopyrightId]);
    }

    public function cloneCopyrightAppointment($id)
    {
        $patent = Patent::findOrFail($id);
        $patent->dtm_schedule = $patent->copyright->dtm_schedule;
        $patent->char_patent_status = 'To submit';
        if ($patent->save()) {
            $userId = $patent->copyright->applicant->user->id;
            User::findOrFail($userId)->notify(new SetAppointmentCloned);       
            return redirect()->back()->with('success', "Project's patent appointment was 
                also set to its relative copyright appointment. Status had 
                changed to 'To submit'");
        }
    }
}
