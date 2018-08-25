<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectType;

class ProjectTypeController extends Controller
{
    # Controller for Project Type record maintenance
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function maintainProjectTypes()
    {
        $projectTypes = ProjectType::all();
        return view('admin.maintenance.project-type', ['projectTypes' => $projectTypes]);
    }

    public function showProjectType($id)
    {
        $projectType = ProjectType::findOrFail($id);
        $otherProjectTypes = ProjectType::all();
        return view('admin.maintenance.view-project-type', ['projectType' => $projectType, 
    			'otherProjectTypes' => $otherProjectTypes]);	
    }

    public function addProjectType(Request $request)
    {
        $this->validate($request, [
        'txtProjectType' => 'required',
        'radioProjectType' => 'required'
 	   ]);

        // Store record to database
        $projectType = new ProjectType;
        $projectType->char_project_type = $request->txtProjectType;
        $projectType->char_classification = $request->radioProjectType;
        if ($projectType->save()) {
            return redirect('/admin/maintenance/project-types')->with('success', 'Project type added!');
        }    
    }

    public function updateProjectType(Request $request, $id)
    {
        $this->validate($request, [
        'txtProjectType' => 'required',
        'radioProjectType' => 'required'
 	   ]);

        // Store record to database
        $projectType = ProjectType::findOrFail($id);
        $projectType->char_project_type = $request->txtProjectType;
        $projectType->char_classification = $request->radioProjectType;
        if ($projectType->save()) {
            return redirect('/admin/maintenance/project-type/'.$id)->with('success', 'Project type updated!');
        }  
    }
}
