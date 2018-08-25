<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\Project;
use App\ProjectType;

class ProjectController extends Controller
{
    # Controller for Project record maintenance
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function maintainProjects()
    {
        $projects = Project::all(); 
        $projectTypes = ProjectType::all();   
        $departments = Department::all();
        return view('admin.maintenance.project', ['projects' => $projects, 
            'departments' => $departments, 
            'projectTypes' => $projectTypes]);
    }

    public function viewProject($id, $deptId)
    {
        $project = Project::findOrFail($id);
        $departments = Department::orderBy('char_department_code', 'asc')
            ->get();
        $projectTypes = ProjectType::all();
        $otherProjects = Project::where([
            ['int_department_id', $deptId], 
            ['int_id', '!=', $id]
            ])
            ->orderBy('str_project_name')
            ->limit(10)
            ->get();
        return view('admin.maintenance.view-project', ['project' => $project, 
            'departments' => $departments, 'otherProjects' => $otherProjects, 
            'projectTypes' => $projectTypes]);
    }

    public function addProject(Request $request)
    {
        $this->validate($request, [
            'txtProjectName' => 'required',
            'slctProjectTypeId' => 'required',
            'slctDepartmentId' => 'required',
            'slctYearLevelId' => 'required',
            'slctSemesterId' => 'required'
        ]);

        $project = new Project;
        $project->int_department_id = $request->input('slctDepartmentId');
        $project->int_project_type_id = $request->slctProjectTypeId;
        $project->str_project_name = $request->input('txtProjectName');
        $project->int_year_level = $request->slctYearLevelId;
        $project->char_semester = $request->slctSemesterId;
        // Ternary opt for inserting project description data
        $projectDescription = $request->input('txtAreaProjectDescription');
        $projectDescription == NULL ? 
        $project->mdmTxt_project_description = 
            'There is no description submitted for '.$request->input('txtProjectName').'.' : 
        $project->mdmTxt_project_description = $projectDescription;
        if($project->save()) {
            return redirect('/admin/maintenance/projects')->with('success', 'Project added!');
        }
    }

    public function updateProject(Request $request, $id, $deptId)
    {
        $this->validate($request, [
            'txtProjectName' => 'required',
            'slctProjectTypeId' => 'required',
            'slctDepartmentId' => 'required'
        ]);
        // Update record
        $project = Project::findOrFail($id);
        $project->int_department_id = $request->input('slctDepartmentId');
        $project->str_project_name = $request->input('txtProjectName');
        $project->int_project_type_id = $request->slctProjectTypeId;
        // Ternary opt for inserting project description data
        $projectDescription = $request->input('txtAreaProjectDescription');
        $projectDescription == NULL ? 
        $project->mdmTxt_project_description = 
            'There is no description submitted for '.$request->input('txtProjectName').
            '.' : $project->mdmTxt_project_description = $projectDescription;

        if($project->save()) {
            return redirect('/admin/maintenance/project/'.$id.'/'.$deptId)
                ->with('success', 'Project updated!');
        }
    }
}
