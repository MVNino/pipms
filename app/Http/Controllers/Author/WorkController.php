<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewMyProjects()
    {
        return view('author-pd.my-projects');
       
    }


}
