<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;
use App\Department;
use App\College;
use App\Branch;
use App\User;

class AuthorController extends Controller
{
    # PAPER DASHBOARD
    public function pdDashboard()
    {
       return view('author-pd.dashboard'); 
    }

    public function viewProfile()
    {
        $author = Applicant::findOrFail(auth()->user()->id);
        $departments = Department::all();
        return view('author-pd.user-profile', ['author' => $author, 
            'departments' => $departments]);
    } 

    public function viewMails()
    {
        return view('author-pd.my-mails');
    }

    public function viewIPRApplication()
    {
        return view('author-pd.ipr-application');
    }

    public function viewMyProjects()
    {
        return view('author-pd.my-projects');
    }

    public function viewInfo()
    {
        return view('author-pd.info');
    }
    public function updateAuthor(Request $request, $id)
    {
    	$this->validate($request, [
            'txtFirstName' => 'required|max:155',
            'txtMiddleName' => 'nullable|max:155',
            'txtLastName' => 'required|max:155',
            'txtEmail' => 'required',
            'txtUsername' => 'required|string|max:155',
            'txtMobileNumber' => 'required',
            'txtTelephoneNumber' => 'required',
            'txtHomeAddress' => 'required',
            'slctDepartmentId' => 'required'
    	]);
    	
    	// Update user
        $user = User::findOrFail(auth()->user()->id);
    	$user->str_first_name = $request->txtFirstName;
    	$user->str_middle_name = $request->txtMiddleName;
    	$user->str_last_name = $request->txtLastName;
    	$user->email = $request->txtEmail;
    	$user->str_username = $request->txtUsername;
    	if ($user->save()) {
    		$applicant = Applicant::findOrFail($id);
    		$applicant->int_department_id = $request->slctDepartmentId;
    		$applicant->bigInt_cellphone_number = $request->txtMobileNumber;
    		$applicant->mdmInt_telephone_number = $request->txtTelephoneNumber;
    		$applicant->str_home_address = $request->txtHomeAddress;
    		if ($applicant->save()) {
    			return redirect()->back()->with('success', 'Account updated!');
    		}
    	}
     }
}
