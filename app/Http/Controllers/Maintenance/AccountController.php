<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AccountController extends Controller
{
    # Controller for Account record maintenance 
   	public function __construct()
    {
        $this->middleware('auth');
    }
    public function maintainAccounts()
    {  
        $users = User::all();
        return view('admin.maintenance.account')->with('users', $users);
    }
}
