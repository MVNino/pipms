<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class DepartmentController extends Controller
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
        $this->column = 'departments.char_department_code';
        $this->middleware('auth');
    }

    public function listDepartments()
    {
        $patentStats = $this->patent
        	->patentStats($this->column);
        $copyrightStats = $this->copyright
        	->copyrightStats($this->column);
    	return view($this->viewPath.'list-departments', 
            ['copyrightStats' => $copyrightStats, 
            'patentStats' => $patentStats]);
    }

    public function rangedDepartments(Request $request)
    {
        $this->validate($request, [
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;

        $copyrights = $this->copyright
            ->rangedCopyrights($this->column, $dateStart, $dateEnd);
        $patentStats = $this->patent->rangedPatents($this->column, $dateStart, $dateEnd);
        $dateStart = date('m/d/Y', strtotime($request->dateStart));
        $dateEnd = date('m/d/Y', strtotime($request->dateEnd));
        return view($this->viewPath.'ranged-departments', 
            ['copyrightStats' => $copyrights, 'patentStats' => $patentStats, 
                'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
    }
}
