<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ApplicantRequests;
use App\Applicant;
use App\CoAuthor;
use App\Copyright;
use App\Department;
use App\Project;
use App\ProjectType;
use App\User;

class IPRApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function viewIPRApplication()
    {
        $projects = Project::all();
        $projectTypes = ProjectType::all();
        return view('author-pd.ipr-application', ['projects' => $projects,
            'projectTypes' => $projectTypes]);
    }
    
	public function storeCopyrightRequest(Request $request)
	{
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha',
            'slctProjectType' => 'required',
            'txtProjectTitle' => 'required',
            'txtAreaDescription' => 'nullable',
            'fileExecutiveSummary' => 'nullable'
        ]);
        // store data to copyrights table
		$applicantId = auth()->user()->applicant->int_id;
        $applicantSingle = Applicant::findOrFail($applicantId);
        // Store co-author
        $applicantSingle->coAuthors()->saveMany([
            new CoAuthor(['int_applicant_id' => $applicantSingle->int_id, 'str_first_name' => $request->txtCAFirstName, 
                'str_middle_name' => $request->txtCAMiddleName, 
                'str_last_name' => $request->txtCALastName]),
            new CoAuthor(['int_applicant_id' => $applicantSingle->int_id, 'str_first_name' => $request->txtCAFirstName2, 
                'str_middle_name' => $request->txtCAMiddleName2, 
                'str_last_name' => $request->txtCALastName2]),
            new CoAuthor(['int_applicant_id' => $applicantSingle->int_id, 'str_first_name' => $request->txtCAFirstName3, 
                'str_middle_name' => $request->txtCAMiddleName3, 
                'str_last_name' => $request->txtCALastName3])
        ]);

        if($request->txtAreaDescription == ''){
            $projectDescription = 'There is no description supplied.';
        } else {
            $projectDescription = $request->txtAreaDescription;
        }
        $copyright = new Copyright;
        $copyright->int_applicant_id = $applicantId;
        $copyright->str_project_title = $request->txtProjectTitle;
        $copyright->int_project_type_id = $request->slctProjectType;
        $copyright->int_project_id = $request->slctProject;
        $copyright->mdmTxt_project_description = $projectDescription;
        // Handle file upload for project's executive summary
        if($request->hasFile('fileExecutiveSummary')){
            // Get the file's extension
            $fileExtension = $request->file('fileExecutiveSummary')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $summaryFileNameToStore = $request->txtProjectTitle
                .'_'.'executiveSummaryFile'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileExecutiveSummary')
                ->storeAs('public/summary/copyright', $summaryFileNameToStore);
            $copyright->str_exec_summary_file = $summaryFileNameToStore;
        }
        if ($copyright->save()) {
            // notify
        $department = Department::findOrFail(auth()->user()->applicant->int_department_id);
        $userId = User::min('id');
        $user = User::findOrFail($userId);
        // $user->notify(ApplicantRequests($txtFirstName, $txtLastName, $department));

        \Notification::send($user, new ApplicantRequests(auth()->user()->str_first_name, auth()->user()->str_last_name, $department));
            return redirect()->back()->with('success', 'Submitted!');
        }
	}
}
