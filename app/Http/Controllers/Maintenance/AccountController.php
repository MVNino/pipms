<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    # Controller for Account record maintenance 
   	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function maintainAccounts()
    {  
        $users = User::where('isAdmin', 1)->get();
        return view('admin.maintenance.account')->with('users', $users);
    }

    public function addAnotherAdmin(Request $request)
    {
        $this->validate($request, [
            // 'g-recaptcha-response' => 'required|captcha',
            'txtFirstName' => 'required|string|max:155',
            'txtMiddleName' => 'nullable|string|max:155',
            'txtLastName' => 'required|string|max:155',
            'txtUsername' => 'required|string|max:155',
            'txtEmail' => 'required|string|email|max:255',
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
            $user->isAdmin = 1;
            if($user->save()) {
                return redirect()->back()->with('success', 'You have registered another admin account!');
            }   
        } else {
            return redirect()->back()->with('error', 'Password fields did not match!');
        }
    }
}
