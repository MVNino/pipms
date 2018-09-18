<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequirementController extends Controller
{
	public function maintainRequirements()
	{
		return view('admin.maintenance.requirement');
	}
}
