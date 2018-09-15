<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IPRApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function viewIPRApplication()
    {
        return view('author-pd.ipr-application');
    }
}
