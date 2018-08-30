<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Branch;
use App\College;

class BranchController extends Controller
{
    # Controller for Branch record maintenance
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function maintainBranches()
    {
        $branches = Branch::all();
        return view('admin.maintenance.branch', ['branches' => $branches]);
    }

    public function viewBranch($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.maintenance.view-branch', ['branch' => $branch]);
    }

    public function addBranch(Request $request)
    {
        $this->validate($request, [
            'txtBranchName' => 'required',
            'txtBranchAddress' => 'required',
            'fileBranchProfileImg' => 'image|nullable|max:3000',
            'fileBranchBannerImg' => 'image|nullable|max:5000'
        ]);
        // Insert record to database
        $branch = new Branch;
        $branch->str_branch_name = $request->input('txtBranchName');
        $branch->str_branch_address = $request->input('txtBranchAddress');
        $branchDescription = $request->input('txtAreaBranchDescription');
        $branchDescription == NULL ? 
        $branch->mdmTxt_branch_description = 
            'There is no description submitted for '.$request->input('txtBranchName').
            '.' : $branch->mdmTxt_branch_description = $branchDescription;

        // Handle file upload for branch profile image
        if($request->hasFile('fileBranchProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileBranchProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $branchProfImgNameToStore = $request->input('txtBranchName')
                .'_'.'branchProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileBranchProfileImg')
                ->storeAs('public/images/branch/profile', $branchProfImgNameToStore);
            $branch->str_branch_profile_image = $branchProfImgNameToStore;
        }

        // Handle file upload for branch banner image
        if($request->hasFile('fileBranchBannerImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileBranchBannerImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $branchBannerImgNameToStore = $request->input('txtBranchName')
                .'_'.'branchBannerImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileBranchBannerImg')
                ->storeAs('public/images/branch/banner', $branchBannerImgNameToStore);
            $branch->str_branch_banner_image = $branchBannerImgNameToStore;
        }
        $branch->str_branch_contact_link = $request->txtBranchContactLink;
        if($branch->save()){
            return redirect('/admin/maintenance/branches')
                ->with('success', 'Branch added!');
        }
    }

    public function updateBranch(Request $request, $id)
    {
        $this->validate($request, [
            'txtBranchName' => 'required',
            'txtBranchAddress' => 'required',
            'fileBranchProfileImg' => 'image|nullable|max:3000',
            'fileBranchBannerImg' => 'image|nullable|max:5000'
        ]);

        // Save record to database
        $branch = Branch::findOrFail($id);
        $branch->str_branch_name = $request->input('txtBranchName');
        $branch->str_branch_address = $request->input('txtBranchAddress');
        $branchDescription = $request->input('txtAreaBranchDescription');
        $branchDescription == NULL ? 
        $branch->mdmTxt_branch_description = 
            'There is no description submitted for '.$request->input('txtBranchName').'.': 
        $branch->mdmTxt_branch_description = $branchDescription;
        
        // Handle file upload for branch profile image
        if($request->hasFile('fileBranchProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileBranchProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $branchProfImgNameToStore = $request->input('txtBranchName')
                .'_'.'branchProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileBranchProfileImg')
                ->storeAs('public/images/branch/profile', $branchProfImgNameToStore);
            // Delete the previous branch profile image
                // NOT WORKING !!!
                Storage::delete('/public/images/branch/profile'.
                    $branch->str_branch_profile_image);
            $branch->str_branch_profile_image = $branchProfImgNameToStore;
        }

        // Handle file upload for branch banner image
        if($request->hasFile('fileBranchBannerImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileBranchBannerImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $branchBannerImgNameToStore = $request->input('txtBranchName')
                .'_'.'branchBannerImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileBranchBannerImg')
                ->storeAs('public/images/branch/banner', $branchBannerImgNameToStore);
            $branch->str_branch_banner_image = $branchBannerImgNameToStore;
        }
        $branch->str_branch_contact_link = $request->txtBranchContactLink;
        if($branch->save()){
            return redirect('/admin/maintenance/branch/'.$id)
                ->with('success', 'Branch updated!');
        }
    }
}
