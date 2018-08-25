<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\College;
use App\Department;

class DepartmentController extends Controller
{
    # Controller for Department record maintenance
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function maintainDepartments()
    {
    	$departments = Department::all();
        $colleges = College::orderBy('char_college_code')->get();
        return view('admin.maintenance.department', ['departments' => $departments, 
                    'colleges' => $colleges]);
    }

    public function viewDepartment($id)
    {
        $department = Department::findOrFail($id);
        $colleges = College::orderBy('char_college_code', 'asc')->get();
        return view('admin.maintenance.view-department', 
            ['department' => $department, 'colleges' => $colleges]);
    }

    public function addDepartment(Request $request)
    {
        $this->validate($request, [
            'txtDepartmentCode' => 'required',
            'txtDepartmentName' => 'required',
            'slctCollegeId' => 'required',
            'fileDepartmentProfileImg' => 'image|nullable|max:3000',
            'fileDepartmentBannerImg' => 'image|nullable|max:5000',
        ]);

        // Save to table 'departments'
        $department = new Department;
        $department->int_college_id = $request->input('slctCollegeId');
        $department->char_department_code = $request->input('txtDepartmentCode');
        $department->str_department_name = $request->input('txtDepartmentName');
        // Ternary opt for inserting department description data
        $departmentDescription = $request->input('txtAreaDepartmentDescription');
        $departmentDescription == NULL ? 
        $department->mdmTxt_department_description = 
            'There is no description submitted for '.$request->input('txtDepartmentCode').'.' : 
        $department->mdmTxt_department_description = $departmentDescription;

        // Handle file upload for department profile image
        if($request->hasFile('fileDepartmentProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileDepartmentProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $departmentProfImgNameToStore = $request->input('txtDepartmentCode')
                .'_'.'deptProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileDepartmentProfileImg')
                ->storeAs('public/images/department/profile', 
                    $departmentProfImgNameToStore);
            $department->str_department_profile_image = $departmentProfImgNameToStore;
        }

        // Handle file upload for department banner image
        if($request->hasFile('fileDepartmentBannerImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileDepartmentBannerImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $departmentBannerImgNameToStore = $request->input('txtDepartmentCode')
                .'_'.'deptBannerImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileDepartmentBannerImg')
                ->storeAs('public/images/department/banner', 
                    $departmentBannerImgNameToStore);
            $department->str_department_banner_image = $departmentBannerImgNameToStore;
        }

        if ($department->save()){;
        return redirect('/admin/maintenance/departments')->with('success', 
            'Department record added!');
        }
    }

    public function editDepartment($id)
    {
        $departments = Department::join('colleges', 
                    'departments.int_college_id', '=', 'colleges.int_id')
                ->select('departments.int_id', 'char_department_code', 
                    'str_department_name', 'char_college_code', 
                    'str_college_name')
                 ->where('departments.int_id', $id)
                ->get();
        $colleges = College::select('int_id', 'char_college_code')
                    ->get();
        return view('admin.maintenance.edit-department', 
            ['departments' => $departments, 
            'colleges' => $colleges]);
    }
    public function updateDepartment(Request $request, $id)
    {
        $this->validate($request, [
            'txtDepartmentCode' => 'required',
            'txtDepartmentName' => 'required',
            'slctCollegeId' => 'required'
        ]);
        // Update record to 'departments' table
        $department = Department::find($id);
        $department->int_college_id = $request->input('slctCollegeId');
        $department->char_department_code = $request->input('txtDepartmentCode');
        $department->str_department_name = $request->input('txtDepartmentName');
        
        // Handle file upload for department profile image
        if($request->hasFile('fileDepartmentProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileDepartmentProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $departmentProfImgNameToStore = $request->input('txtDepartmentCode')
                .'_'.'deptProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileDepartmentProfileImg')
                ->storeAs('public/images/department/profile', 
                    $departmentProfImgNameToStore);
            $department->str_department_profile_image = $departmentProfImgNameToStore;
        }

        // Handle file upload for department banner image
        if($request->hasFile('fileDepartmentBannerImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileDepartmentBannerImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $departmentBannerImgNameToStore = $request->input('txtDepartmentCode')
                .'_'.'deptBannerImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileDepartmentBannerImg')
                ->storeAs('public/images/department/banner', 
                    $departmentBannerImgNameToStore);
            $department->str_department_banner_image = $departmentBannerImgNameToStore;
        }
        $department->save();
        return redirect('/admin/maintenance/department/'.$id)->with('success', 
            'Department record updated!');
    }
}
