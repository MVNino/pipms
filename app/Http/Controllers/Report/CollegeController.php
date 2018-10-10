<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\College;
use App\Copyright;
use App\Patent;

class CollegeController extends Controller
{
	public $viewPath;
    public $copyright;
    public $patent;
    public $column;
  
    public function __construct()
    {
        $this->viewPath = 'admin.reports.';
        $this->copyright = new Copyright;
        $this->patent = new Patent;
        $this->column = 'colleges.char_college_code';
        $this->middleware('auth');
    }

    public function listColleges()
    {
        $patentStats = $this->patent
            ->patentStats($this->column);
        $copyrightStats = $this->copyright
            ->copyrightStats($this->column);
    	return view($this->viewPath.'list-colleges', 
            ['copyrightStats' => $copyrightStats, 
            'patentStats' => $patentStats]);
    }
}