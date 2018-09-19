<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Requirement;

class RequirementController extends Controller
{
	public function maintainRequirements()
	{
		$requirements = Requirement::all();
		return view('admin.maintenance.requirement', 
				['requirements' => $requirements]);
	}

	public function addRequirement(Request $request)
	{
		$this->validate($request, [
			'txtAreaRequirement' => 'required',
			'radioIPR' => 'required'
		]);

		$requirement = new Requirement;
		$requirement->str_requirement = $request->txtAreaRequirement;
		$requirement->char_ipr = $request->radioIPR;
		if ($requirement->save()) {
			return redirect()->back()->with('success', 'Requirement added!');
		}
	}
}
