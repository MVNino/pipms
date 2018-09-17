<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ApplicantRequests;
use App\Notifications\ApplicantRequestsPatent;
use App\Applicant;
use App\CoAuthor;
use App\Copyright;
use App\Department;
use App\Patent;
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

    public function viewPatentApplication($id)
    {
         // For creating/submission of patent related informations & file
        $copyrightId = $id;
        $projects = Project::all();
        $projectTypes = ProjectType::all();
        return view('author-pd.ipr-patent-application', ['projects' => $projects, 
            'projectTypes' => $projectTypes, 'copyrightId' => $copyrightId]);
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

    public function storePatentRequest(Request $request)
    {
        // storing input data to database(Patent table)
        // form validation
        $this->validate($request, [
            // 'g-recaptcha-response' => 'required|captcha',
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
        $patent->int_copyright_id = $request->getCopyrightId;
        $patent->str_patent_project_title = $request->txtPatentTitle;
        $patent->int_project_type_id = $request->slctProjectType;
        $patent->int_project_id = $request->slctProject;
        $patent->mdmTxt_patent_description = $projectDescription;
        if($patent->save()){
        $department = Department::findOrFail(auth()->user()->applicant->int_department_id);
        $userId = User::min('id');
        $user = User::findOrFail($userId);
        \Notification::send($user, new ApplicantRequestsPatent(auth()->user()->str_first_name, auth()->user()->str_last_name, $department));
            return redirect()->back()
            ->with('success', 'Request for patent registration submitted!');
        }
    }

}
