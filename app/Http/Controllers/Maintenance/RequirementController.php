<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

	public function viewRequirement($id)
	{
		$requirement = Requirement::findOrFail($id);
        $requirements = Requirement::where('char_ipr', 
        	$requirement->char_ipr)
        	->get();
		return view('admin.maintenance.view-requirement', 
			['requirement' => $requirement, 
			'requirements' => $requirements]);

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

	public function updateRequirement(Request $request, $id)
    {
        $this->validate($request, [
			'txtAreaRequirement' => 'required',
			'radioIPR' => 'required'
		]);

		$requirement = Requirement::find($id);
		$requirement->str_requirement = $request->input('txtAreaRequirement');
		$requirement->char_ipr = $request->input('radioIPR');
		if ($requirement->save()) {
			return redirect()->back()->with('success', 'Requirement Updated!');
		}
    }
}
