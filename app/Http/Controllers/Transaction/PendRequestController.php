<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ApplicantRequests;
use App\Notifications\ApplicantRequestsPatent;
use App\CoAuthor;
use App\Copyright;
use App\Department;
use App\Patent;
use App\Project;
use App\ProjectType;
use App\Applicant;
use App\User;
class PendRequestController extends Controller
{
	public function viewCopyrightApplication()
	{
        $projects = Project::all();
        $projectTypes = ProjectType::all();  
		return view('author.copyright-application', 
			['projects' => $projects, 'projectTypes' => $projectTypes]);
	}

    public function listPendingCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'LIKE', '%pending%')
            ->get();
        return view('admin.transaction.copyright-pending', ['copyrights' => $copyrights]);
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

    public function storePatentRequest(Request $request)
    {
        // storing input data to database(Patent table)
        // form validation
        $this->validate($request, [
            'getCopyrightId' => 'required',
            'slctProjectType' => 'required',
            'txtPatentTitle' => 'required',
            'txtAreaPatentDescription' => 'required'
        ]);

        /*
        * set default value for project/invention
        * description if it was left blank
        */
        if($request->txtAreaPatentDescription == ''){
            $projectDescription = 'There is no description supplied.';
        } else {
            $projectDescription = $request->txtAreaPatentDescription;
        }

        // Store input data to Patents table
        $patent = new Patent;
        // $patent->int_copyright_id = $request->getCopyrightId;
        $patent->int_copyright_id = 2;
        $patent->str_patent_project_title = $request->txtPatentTitle;
        $patent->int_project_type_id = $request->slctProjectType;
        $patent->int_project_id = $request->slctProject;
        $patent->mdmTxt_patent_description = $projectDescription;
        if($patent->save()){
        $department = department::findOrFail(auth()->user()->applicant->int_department_id);
        $userId = User::min('id');
        $user = User::findOrFail($userId);
        \Notification::send($user, new ApplicantRequestsPatent(auth()->user()->str_first_name, auth()->user()->str_last_name, $department));
            return redirect()->back()
            ->with('success', 'Request for patent registration submitted!');
        }
    }

}
