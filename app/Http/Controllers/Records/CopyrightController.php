<?php

namespace App\Http\Controllers\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copyright;
use App\Patent;

class CopyrightController extends Controller
{
    # Controller for Copyright records
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listCopyrights()
    {
        $copyrights = Copyright::all();
        return view('admin.records.list-copyrights', ['copyrights' => $copyrights]);
    }

    public function viewCopyright($id)
    {   
        $copyrightCollection = Copyright::with('applicant.department.college.branch')
            ->where('int_id', $id)
            ->get();
        return view('admin.records.view-copyright', 
            ['copyrightCollection' => $copyrightCollection]);
    }


}
