<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Notifications\AuthorAccountRequested;
use App\Notifications\AuthorReadyForRegistration;
use App\Notifications\AnAuthorAccountAdded;
use App\Notifications\AccountRequestRevision;
use Illuminate\Support\Facades\Hash;
use App\Applicant;
use App\AuthorAccountRequest;
use App\Receipt;
use App\User;

class RegisterAuthorController extends Controller
{

    public function showRegistrationForm()
    {  
        return view('guest.initial-author-registration'); 
    }

    public function requestAuthorAccount(Request $request)
    {
    	$this->validate($request, [
            // 'g-recaptcha-response' => 'required|captcha',
            'slctApplicantType' => 'required',
            'radioGender' => 'required',
            'birthdate' => 'required',
            'txtFirstName' => 'required|max:155',
            'txtMiddleName' => 'nullable|max:155',
            'txtLastName' => 'required|max:155',
            'txtEmail' => 'required',
            'txtReceiptCode' => 'required',
            'fileReceiptImg' => 'image|required|max:1500'
    	]);

    	// insert some to applicant
    	$applicant = new Applicant;
    	$applicant->char_gender = $request->radioGender;
    	$applicant->dtm_birthdate = $request->birthdate;
    	$applicant->char_applicant_type = $request->slctApplicantType;
		if($applicant->save()) {
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

        	if($receipt->save()) {
        		$authorAccoRequest = new AuthorAccountRequest;
        		$authorAccoRequest->int_applicant_id = $applicantMaxId;
        		$authorAccoRequest->str_first_name = $request->txtFirstName;
        		$authorAccoRequest->str_middle_name = $request->txtMiddleName;
        		$authorAccoRequest->str_last_name = $request->txtLastName;
        		$authorAccoRequest->str_email = $request->txtEmail;
        		$authorAccoRequest->str_account_request_token = $request->_token;
        		if($authorAccoRequest->save()) {
	                $userid = User::min('id');
	                $user = User::find($userid);
	                // Notify administrator for an account request
	                \Notification::send($user, 
	                	new AuthorAccountRequested($request->txtFirstName, 
	                		$request->txtLastName));
                return redirect('registration/author')->with('success', 
                	'Request for an author account submitted!');
        		}
        	}
		}
    }

    public function listAccountRequests()
    {
        $authAccoRequests = AuthorAccountRequest::with('applicant')
            ->where('char_request_status', '!=', 'approved')
            ->get();
        return view('admin.transaction.list-account-requests', 
            ['authAccoRequests' => $authAccoRequests]);
    }

    public function viewAccountRequest($id)
    {
        $accountRequest = AuthorAccountRequest::findOrFail($id);
        return view('admin.transaction.view-account-request', 
            ['accountRequest' => $accountRequest]);
    }

    public function random_code()
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
    }

    public function approveAccountRequest($id)
    {
        $accountRequestToken = $this->random_code();
        $authorAccount = AuthorAccountRequest::find($id);
        $authorAccount->char_request_status = 'approved';
        $authorAccount->str_account_request_token = $accountRequestToken;
        if($authorAccount->save()) {
            \Notification::route('mail', $authorAccount->str_email)
                ->notify(new AuthorReadyForRegistration($authorAccount->applicant->int_id, $authorAccount->str_first_name, $accountRequestToken));
            return redirect()->back()->with('success', 'Account request approved!');
        }      
    }

    public function authorAccountRegistration($applicantId, $registrationToken)
    {
        $applicant = Applicant::findOrFail($applicantId);
        if($applicant->authorAccountRequest->str_account_request_token == $registrationToken) {
            return view('guest.author-registration', ['applicant' => $applicant, 
                'registrationToken' => $registrationToken]);
        } else {
            return view('admin.includes.page-error');
        }
    }

    public function grantAuthorAccount(Request $request, $applicantId)
    {
        // total registration of an author
        // transafe name to user
        // delete record sa 'authoraccountrequest' table
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha',
            'txtUsername' => 'required|string|max:155',
            'txtPassword' => 'required|string|min:6',
            'txtRePassword' => 'required|string|min:6',
        ]);

        if ($request->txtPassword === $request->txtRePassword) {
            $user = new User;
            $user->str_first_name = $request->txtFirstName;
            $user->str_middle_name = $request->txtMiddleName;
            $user->str_last_name = $request->txtLastName;
            $user->str_username = $request->txtUsername;
            $user->email = $request->txtEmail;
            $user->password = Hash::make($request->txtPassword);
            $user->isAdmin = 0;
            if($user->save()) {
                // remove the record in author_account_request table
                $applicant = Applicant::findOrFail($applicantId);
                AuthorAccountRequest::findOrFail($applicant->authorAccountRequest->int_id)
                    ->delete(); 
                // update fk for users
                $maxUserId = User::max('id');
                $applicant->int_user_id = $maxUserId;
                if ($applicant->save()) {    
                    $userid = User::min('id');
                    $user = User::find($userid);
                    // Notify administrator for an account request
                    \Notification::send($user, 
                        new AnAuthorAccountAdded($request->txtFirstName, 
                            $request->txtLastName));
                    return redirect('/author-login')->with('success', 'Author Account Registered!');
                }
            }   
        } else {
            return redirect()->back()->with('error', 'Password fields did not match!');
        }
    }

    # NEW
    public function messageAuthor(Request $request)
    {     
        $this->validate($request, [
            'txtEmail' => 'required',
            'txtAreaMessage' => 'required'
        ]);
        // $copyrightId = $request->numCopyrightId;
        // $revisionToken = $this->random_code();
        // $this->putCopyrightRevisionToken($revisionToken, $copyrightId);

        \Notification::route('mail', $request->txtEmail)
            ->notify(new AccountRequestRevision($request->txtFName, $request->txtAreaMessage));

        $promptMsg = 'Mail sent!';
        return redirect()->back()->with('success', $promptMsg);
    }

}
