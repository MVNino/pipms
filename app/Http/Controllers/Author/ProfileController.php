<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Department;
use App\College;
use App\Branch;
use App\User;
use App\CoAuthor;

class ProfileController extends Controller
{
    # Author user-profile
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewProfile()
    {
        $author = Applicant::findOrFail(auth()->user()->applicant->int_id);
        $coAuthors = CoAuthor::all();
        $departments = Department::all();
        return view('author-pd.user-profile', ['author' => $author, 
        'departments' => $departments, 'coAuthors' => $coAuthors]);
    }

    public function updateAuthor(Request $request, $id)
    {
    	$this->validate($request, [
            // 'g-recaptcha-response' => 'required|captcha',
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
