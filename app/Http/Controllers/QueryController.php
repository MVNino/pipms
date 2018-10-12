<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Copyright;

class QueryController extends Controller
{
	public function index()
	{
		$copyright = new Copyright;
		//return $copyright->copyrightStats('branches.str_branch_name');
		return view('admin.queries');
	}

	public function queryInfo($param)
	{
		
	}
}