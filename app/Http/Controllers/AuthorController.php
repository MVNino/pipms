<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function viewDashboard()
    {
    	return view('author.dashboard');
    }
}
