<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
use App\College;
use App\Department;

class CollegeController extends Controller
{
    # Controller for College record maintenance
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function maintainColleges()
    {
        $colleges = College::all();
        $branches = Branch::orderBy('str_branch_name', 'asc')->get();
        return view('admin.maintenance.college', ['colleges' => $colleges, 
            'branches' => $branches]);
    }

    public function viewCollege($id)
    {
        $college = College::findOrFail($id);
        $branches = Branch::orderBy('str_branch_name', 'asc')->get();
        return view('admin.maintenance.view-college', 
            ['college' => $college, 'branches' => $branches]);
    }

    public function addCollege(Request $request)
    {
        $this->validate($request, [
            'txtCollegeCode' => 'required',
            'txtCollegeName' => 'required',
            'slctBranchId' => 'required',
            'fileCollegeProfileImg' => 'image|nullable|max:3000',
            'fileCollegeBannerImg' => 'image|nullable|max:5000'
        ]);

        // Save to table 'colleges'
        $college = new College;
        $request->input('slctBranchId') != 'Select branch' ? 
        $college->int_branch_id = $request->input('slctBranchId') : 
        $college->int_branch_id = 1;
        $college->char_college_code = $request->input('txtCollegeCode');
        $college->str_college_name = $request->input('txtCollegeName');
        $collegeDescription = $request->input('txtAreaCollegeDescription');
        $collegeDescription == NULL ? 
        $college->mdmTxt_college_description = 
            'There is no description submitted for '.$request->input('txtCollegeCode').'.': 
        $college->mdmTxt_college_description = $collegeDescription;

        // Handle file upload for college profile image
        if($request->hasFile('fileCollegeProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileCollegeProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $collegeProfImgNameToStore = $request->input('txtCollegeCode')
                .'_'.'collegeProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileCollegeProfileImg')
                ->storeAs('public/images/college/profile', 
                    $collegeProfImgNameToStore);
            $college->str_college_profile_image = $collegeProfImgNameToStore;
        }

        // Handle file upload for college banner image
        if($request->hasFile('fileCollegeBannerImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileCollegeBannerImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $collegeBannerImgNameToStore = $request->input('txtCollegeCode')
                .'_'.'collegeBannerImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileCollegeBannerImg')
                ->storeAs('public/images/college/banner', 
                    $collegeBannerImgNameToStore);
            $college->str_college_banner_image = $collegeBannerImgNameToStore;
        }
        $college->str_college_contact_link = $request->txtCollegeContactLink;
        if ($college->save()) {
            return redirect('/admin/maintenance/colleges')
                ->with('success', 'College added!');   
        }
    }

    public function updateCollege(Request $request, $id)
    {
        $this->validate($request, [
            'txtCollegeCode' => 'required',
            'txtCollegeName' => 'required',
            'slctBranchId' => 'required'
        ]);
        // Update record to 'colleges' table
        $college = College::find($id);
        $college->char_college_code = $request->input('txtCollegeCode');
        $college->str_college_name = $request->input('txtCollegeName');
        $college->int_branch_id = $request->slctBranchId;

        // Handle file upload for college profile image
        if($request->hasFile('fileCollegeProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileCollegeProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $collegeProfImgNameToStore = $request->input('txtCollegeName')
                .'_'.'collegeProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileCollegeProfileImg')
                ->storeAs('public/images/college/profile', $collegeProfImgNameToStore);
            $college->str_college_profile_image = $collegeProfImgNameToStore;
        }

        // Handle file upload for college banner image
        if($request->hasFile('fileCollegeBannerImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileCollegeBannerImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $collegeBannerImgNameToStore = $request->input('txtCollegeName')
                .'_'.'collegeBannerImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileCollegeBannerImg')
                ->storeAs('public/images/college/banner', $collegeBannerImgNameToStore);
            $college->str_college_banner_image = $collegeBannerImgNameToStore;
        }
        $college->str_college_contact_link = $request->txtCollegeContactLink;
        if ($college->save()) {
            return redirect('/admin/maintenance/college/'.$id)->with('success', 
                    'College record updated!');
        }
    }

}
