<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class CopyrightController extends Controller
{
    # Controller for Copyright records
	public $viewPath;
	public $copyright;
    
    public function __construct()
    {
    	$this->viewPath = 'admin.reports.';
    	$this->copyright = new Copyright;
        $this->middleware('auth');
    }

    public function listCopyrights()
    {
    	// extract all records(eager loading)
    	$copyrights = $this->copyright->allRecords();

        return view($this->viewPath.'list-copyright', 
        	['copyrights' => $copyrights]);
    }

    public function viewCopyright($id)
    {   
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('char_copyright_status', 'copyrighted')
            ->where('dtm_copyrighted', '!=', NULL)
            ->where('int_id', $id)
            ->get();

        return view($this->viewPath.'view-copyright', 
            ['copyrightCollection' => $copyrightCollection]);
    }
}
