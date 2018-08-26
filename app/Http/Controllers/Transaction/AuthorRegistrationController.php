<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AuthorRegistrationController extends Controller
{
    public function requestAuthorAccount(Request $request)
    {
    	return $request->_token;
    	$this->validate($request, [
            'slctApplicantType' => 'required',
            'radioGender' => 'required',
            'txtFirstName' => 'required',
            'txtLastName' => 'required',
            'txtEmail' => 'required',
            'txtReceiptCode' => 'required',
            'fileReceiptImg' => 'image|required|max:1500'
    	]);
    	
    }
}
