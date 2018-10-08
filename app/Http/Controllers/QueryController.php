<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueryController extends Controller
{
	public function index()
	{
		return view('admin.queries.index');
	}
}