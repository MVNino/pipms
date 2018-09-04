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
        return view('author-pd.user-profile');
    } 

    public function viewDashboard()
    {
    	return view('author.dashboard');
    }

    public function viewMessages()
    {
    	return view('author.messages');
    }

    public function viewMyAccount()
    {
        $branches = Branch::all();
        // get college data
        $colleges = College::orderBy('char_college_code')->get();
        // get department data
        $departments = Department::orderBy('char_department_code', 'asc')->get();
    	return view('author.my-account', ['branches' => $branches, 
    		'colleges' => $colleges, 'departments' => $departments]);
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
            'slctDepartment' => 'required'
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
    		$applicant->int_department_id = $request->slctDepartment;
    		$applicant->bigInt_cellphone_number = $request->txtMobileNumber;
    		$applicant->mdmInt_telephone_number = $request->txtTelephoneNumber;
    		$applicant->str_home_address = $request->txtHomeAddress;
    		if ($applicant->save()) {
    			return redirect('/author/my-account')->with('success', 'Account updated!');
    		}
    	}
    	// update fname, mname, lname, email, username, cellphonenum, telephone num, home address, department
     }

     public function listMyProjects()
     {
        return view('author.list-my-projects');
     }

     public function myAccount()
     {
        return view('author.my-account');
     }



     public function myProjects()
     {
        return view('author.my-projects');
     }

     public function myMessages()
    {
        return view('author.my-messages');
    }

    public function editProfiles()
    {
        return view('author.edit-profile');
    }
}
