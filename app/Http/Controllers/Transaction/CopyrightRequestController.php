<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\User;

class CopyrightRequestController extends Controller
{
	public function listCopyrightRequests()
	{
		$copyrights = Copyright::all();
		return view('admin.transaction.list-copyright-requests', 
			['copyrights' => $copyrights]);
	}
}
