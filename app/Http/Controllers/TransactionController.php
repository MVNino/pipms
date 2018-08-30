<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Notifications\ApplicantRequests;
use App\Notifications\AppointmentSet;
use App\Notifications\RequestRevision;
use App\Notifications\RequestOnProcess;
use App\Notifications\RequestOnProcessDb;
use App\Notifications\WorkCopyrighted;
use App\Notifications\WorkCopyrightedDb;
use App\Notifications\ApplicationFormRevised;
use App\Notifications\PatentRequestAppointmentSet;
use App\Notifications\PatentAppointmentSetDb;
use App\Notifications\SetAppointmentCloned;
use App\Notifications\PatentRequestOnProcess;
use App\Notifications\PatentOnProcessDb;
use App\Notifications\WorkPatented;
use App\Notifications\WorkPatentedDb;
use App\Notifications\AppointmentSetDb;
use App\Notifications\InitialApplicationForCopyrightRequested;
use App\Notifications\RequestForOnlineCopyrightInitialApplicationAccepted;
use App\Applicant;
use App\Branch;
use App\College;
use App\Copyright;
use App\CoAuthor;
use App\Department;
use App\Patent;
use App\Project;
use App\ProjectType;
use App\Receipt;
use App\User;
use Carbon\Carbon;
use DB;

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
        $this->middleware('auth', ['except' => ['devCopyrightForm', 'requestInitialCopyrightForm']]);
    }


    public function devCopyrightForm()
    {
        $branches = Branch::all();
        // get college data
        $colleges = College::orderBy('char_college_code')->get();
        // get department data
        $departments = Department::orderBy('char_department_code', 'asc')->get();
        $projects = Project::all();
        $projectTypes = ProjectType::all();  
        return view('guest.copyright-application-request-form', 
            ['branches' => $branches, 'colleges' => $colleges, 
            'departments' => $departments, 'projects' => $projects, 
            'projectTypes' => $projectTypes]);
    }

    public function requestInitialCopyrightForm(Request $request)
    {
        $this->validate($request, [
            'slctApplicantType' => 'required',
            'slctDepartment' => 'required',
            'radioGender' => 'required',
            'txtFirstName' => 'required',
            'txtLastName' => 'required',
            'txtEmail' => 'required',
            'txtReceiptCode' => 'required',
            'fileReceiptImg' => 'image|required|max:2000'
        ]);
        // Store some request data to 'applicants' table
        $applicant = new Applicant;
        $applicant->int_department_id = $request->slctDepartment;
        $applicant->str_first_name = $request->txtFirstName;
        $applicant->str_middle_name = $request->txtMiddleName;
        $applicant->str_last_name = $request->txtLastName;
        $applicant->char_gender = $request->radioGender;
        $applicant->dtm_birthdate = $request->birthdate;
        $applicant->char_applicant_type = $request->slctApplicantType;        
        $applicant->str_email_address = $request->txtEmail;
        
        if ($applicant->save()) {
            // Store some request data to 'copyrights' table
            $applicantMaxId = Applicant::max('int_id'); 
            // Store receipt
            $receipt = new Receipt;
            $receipt->int_applicant_id = $applicantMaxId;
            $receipt->char_receipt_code = $request->txtReceiptCode;
            // Handle file upload process(imgReceipt)
            if($request->hasFile('fileReceiptImg')){
                // Get the file's extension
                $fileExtension = $request->file('fileReceiptImg')
                ->getClientOriginalExtension();
                // Create a filename to store(database)
                $receiptNameToStore = $request->txtReceiptCode.'_'
                .'receipt'.'_'.time().'.'.$fileExtension;
                // Upload file to system
                $path = $request->file('fileReceiptImg')
                ->storeAs('public/images/receipts', $receiptNameToStore);
            }
            $receipt->str_receipt_image = $receiptNameToStore;

            if ($receipt->save()) {
                $department = department::findOrFail($request->slctDepartment);
                $userid = User::max('id');
                $user = User::find($userid);
                // dito na mag nonotif
                \Notification::send($user, new InitialApplicationForCopyrightRequested($request->txtFirstName, $request->txtLastName, $department));
                return redirect('application/ipr-request-form')->with('success', 'Initial request for copyright registration submitted!');
            }                       
        }        
    }

    public function listPendingCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'LIKE', '%pending%')
            ->get();
        return view('admin.transaction.copyright-pending', ['copyrights' => $copyrights]);
    }

    public function viewPendingCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-pending', 
            ['copyrightCollection' => $copyrightCollection]);
    }

    public function listToSubmitCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'To submit')
            ->get();
        return view('admin.transaction.copyright-to-submit', ['copyrights' => $copyrights]);
    }

    public function viewToSubmitCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-to-submit', 
            ['copyrightCollection' => $copyrightCollection]);
    }

    public function listOnProcessCopyrightRequest()
    {
        $copyrights = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'On process')
            ->get();
        return view('admin.transaction.copyright-on-process', ['copyrights' => $copyrights]);  
    }

    public function viewOnProcessCopyrightRequest($id)
    {
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-copyright-on-process', 
            ['copyrightCollection' => $copyrightCollection]); 
    }
    public function random_code()
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
    }

    public function putCopyrightRevisionToken($revisionToken, $copyrightId)
    {
        $copyright = Copyright::findOrFail($copyrightId);
        $copyright->char_copyright_status = 'pending/to-revise';
        $copyright->str_revision_token = $revisionToken;
        return $copyright->save();
    }

    public function messageApplicant(Request $request)
    {
        $this->validate($request, [
            'txtAreaMessage' => 'required'
        ]);
        $copyrightId = $request->numCopyrightId;
        $revisionToken = $this->random_code();
        $this->putCopyrightRevisionToken($revisionToken, $copyrightId);

        \Notification::route('mail', $request->txtEmail)
            ->notify(new RequestRevision($copyrightId, $request->txtFirstName, $request->txtAreaMessage, $revisionToken));

        $promptMsg = 'Mail sent!';
        return redirect()->back()->with('success', $promptMsg);
    }

    public function viewCopyrightRevisionForm($id, $token)
    {

        $branches = Branch::all();
        // get college data
        $colleges = College::orderBy('char_college_code')->get();
        // get department data
        $departments = Department::orderBy('char_department_code', 'asc')->get();
        $projects = Project::all();
        $projectTypes = ProjectType::all();
        $copyright = Copyright::findOrFail($id);
        if ($copyright->str_revision_token == $token) {
            return view('admin.transaction.revise-copyright-application-form', 
            ['branches' => $branches, 'colleges' => $colleges, 
            'departments' => $departments, 'projects' => $projects, 
            'projectTypes' => $projectTypes, 'copyright' => $copyright]);
        } else {
            return view('admin.includes.page-error');
        }
    }

    public function reviseCopyrightForm($id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $copyright = Copyright::findOrFail($id);
        $copyright->char_copyright_status = 'Pending/Revised';
        $copyright->str_revision_token = NULL;
        $copyright->save();
        $firstName = $copyright->applicant->str_first_name;
        $lastName = $copyright->applicant->str_last_name;
        $department = $copyright->applicant->department->char_department_code;
        $college = $copyright->applicant->department->college->char_college_code;
        $branch = $copyright->applicant->department->college->branch->str_branch_name;
        \Notification::send($user, new ApplicationFormRevised($firstName, 
            $lastName, $department, $college, $branch)); 
        return redirect('https://mailtrap.io/inboxes/439074/messages');
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

        $schedule = Carbon::createFromFormat('Y-m-d H:i', $request->dateSchedule.' '.$request->timeSchedule)->toDateTimeString();
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
        return redirect('admin/transaction/copyrights/pend-request')->with('success', $promptMsg);
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
        return redirect('/admin/transaction/copyrights/to-submit')->with('success', $promptMsg);
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

    public function requestForPatent()
    {
        // For creating/submission of patent related informations & file
        $maxCopyrightId = Copyright::max('int_id');
        $projects = Project::all();
        $projectTypes = ProjectType::all();
        return view('admin.transaction.patent-request', ['projects' => $projects, 
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
        $patent->mdmTxt_patent_description = $projectDescription;
        $patent->save();
        return redirect('/admin/transaction/patent-request')
            ->with('success', 'Project/Invention application for patent submitted.');
    }


    public function listPendingPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'LIKE', '%pending%')
            ->get();
        return view('admin.transaction.patent-pending', ['patents' => $patents]);
    }

    public function listToSubmitPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'To submit')
            ->get();
        return view('admin.transaction.patent-to-submit', ['patents' => $patents]);
    }

    public function listOnProcessPatentRequest()
    {
        $patents = Patent::with('copyright.applicant.department.college.branch')
            ->where('char_patent_status', 'On process')
            ->get();
        return view('admin.transaction.patent-on-process', ['patents' => $patents]);
    }

    public function viewPendingPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-pending', 
            ['patentCollection' => $patentCollection]);
    }

    public function viewToSubmitPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-to-submit', 
            ['patentCollection' => $patentCollection]);
    }

    public function viewOnProcessPatentRequest($id)
    {  
        $patentCollection = Patent::with('copyright.applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.transaction.view-patent-on-process', 
            ['patentCollection' => $patentCollection]);
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
    public function setScheduleForPatent(Request $request, $id)
    {
        $this->validate($request, [
            'dateSchedule' => 'required',
            'timeSchedule' => 'required'
        ]);

        $schedule = Carbon::createFromFormat('Y-m-d H:i', $request->dateSchedule.' '.$request->timeSchedule)->toDateTimeString();
        $patent = Patent::findOrFail($id);
        $patent->dtm_schedule = $schedule;
        $patent->char_patent_status = 'To submit';
        $patent->save();
        $promptMsg = 'Appointment set! The patent request record changed its status to "To submit". 
            An email notification has been sent to applicant.';
        \Notification::route('mail', $patent->copyright->applicant->user->email)
            ->notify(new PatentRequestAppointmentSet($schedule));
        $userId = $patent->copyright->applicant->user->id;
        User::findOrFail($userId)->notify(new PatentAppointmentSetDb);     
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

    public function approveInitialRequest($id)
    {
        $applicationToken = $this->random_code();
        $applicant = Applicant::findOrFail($id);
        $applicant->str_application_token = $applicationToken;
        $applicant->save();

        \Notification::route('mail', $applicant->str_email_address)
            ->notify(new RequestForOnlineCopyrightInitialApplicationAccepted($applicant->int_id, $applicant->str_first_name, $applicationToken));
        $promptMsg = 'Initial request approve and mail sent!';
        return redirect()->back()->with('success', $promptMsg);
    }

    // public function putCopyrightApplicationToken()
    // {

    // }


    public function requestForCopyrightForm($applicantId, $applicationToken)
    {
        $applicant = Applicant::findOrFail($applicantId);

        $branches = Branch::all();
        // get college data
        $colleges = College::orderBy('char_college_code')->get();
        // get department data
        $departments = Department::orderBy('char_department_code', 'asc')->get();
        $projects = Project::all();
        $projectTypes = ProjectType::all();

        if ($applicant->str_applicant_token == $applicationToken) {
            return view('guest.copyright.application-form', 
                ['applicant' => $applicant, 'branches' => $branches, 'colleges' => $colleges, 
                'departments' => $departments, 'projects' => $projects, 
                'projectTypes' => $projectTypes]);
        } else {
            return view('admin.includes.page-error');
        }
    }

    public function storeCopyrightRequest(Request $request, $id) 
    {
        /* store copyright's data to our database(copyrights table)
         * form validation
        */
        $this->validate($request, [
            'txtHome' => 'required',
            'slctProjectType' => 'required',
            'txtProjectTitle' => 'required',
            'txtAreaDescription' => 'nullable',
        ]);
        // DATE NOT WORKING!!!!!!
        // Store some request data to 'applicants' table
        $applicant = Applicant::findOrFail($id);
        $applicant->str_home_address = $request->txtHome;
        $applicant->bigInt_cellphone_number = $request->numCellphone;
        $applicant->mdmInt_telephone_number = $request->numTelephone;
        $applicant->save();
        
        $applicantSingle = Applicant::findOrFail($id);

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

        // store to database using eloquent

        /*
        * set default value for project/invention
        * description if it was left blank
        */
        if($request->txtAreaPatentDescription == ''){
            $projectDescription = 'There is no description supplied.';
        } else {
            $projectDescription = $request->txtAreaDescription;
        }

        $copyright = new Copyright;
        $copyright->int_applicant_id = $id;
        $copyright->str_project_title = $request->txtProjectTitle;
        $copyright->int_project_type_id = $request->slctProjectType;
        $copyright->mdmTxt_project_description = $projectDescription;
        $copyright->save();

        $department = department::findOrFail($applicant->int_department_id);
        $user = User::findOrFail(auth()->user()->id);
        // $user->notify(ApplicantRequests($txtFirstName, $txtLastName, $department));

        \Notification::send($user, new ApplicantRequests($applicant->str_first_name, $applicant->str_last_name, $department));
        // redirect page
        return redirect('https://mailtrap.io/inboxes/439074/messages');
    }
}
