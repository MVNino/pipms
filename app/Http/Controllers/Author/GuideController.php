<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function viewGuide()
    {
        return view('author-pd.guide');
    }
}
