<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewUserProfile()
    {
        // render view for user profile
		return view('admin.user-profile');
    }

    public function updateProfilePic(Request $request, $id)
    {
        $this->validate($request, [
            'fileUserProfileImg' => 'image|mimes:jpeg,png,jpg|required|max:1500'
        ]);

        $admin = User::findOrFail($id);
        // Handle file upload for user profile image
        if($request->hasFile('fileUserProfileImg')){
            // Get the file's extension
            $fileExtension = $request->file('fileUserProfileImg')
                ->getClientOriginalExtension();
            // Create a filename to store(database)
            $userProfImgNameToStore = $admin->str_first_name
                .'_'.'AdminProfileImg'.'_'.time().'.'.$fileExtension;
            // Upload file to system
            $path = $request->file('fileUserProfileImg')
                ->storeAs('public/images/profile', $userProfImgNameToStore);
            $admin->str_user_image_code = $userProfImgNameToStore;
        }
        if($admin->save()) {
            return redirect()->back()->with('success', 
                'The profile image has been updated!');
        }
    }

    public function updateUserProfile(Request $request, $id)
    {
        // validate request
    	$this->validate($request, [
    		'txtFirstName' => 'required',
    		'txtLastName' => 'required',
    		'txtUsername' => 'required',
    	]);

        // update record id table 'users'
    	$admin = User::findOrFail($id);
    	$admin->str_first_name = $request->txtFirstName;
    	$admin->str_middle_name = $request->txtMiddleName;
    	$admin->str_last_name = $request->txtLastName;
    	$admin->str_username = $request->txtUsername;
        // save data
    	if($admin->save()) {
    		return redirect()->back();
    	} 
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:6'
        ]);

        $current_password = auth()->user()->password;           
        if(Hash::check($request->currentPassword, $current_password)) {           
            $user_id = auth()->user()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->newPassword); 
            if($obj_user->save()) {
                return redirect()->back()->with('success', 'Your account password has been updated!');
            }
        } else {           
            return redirect()->back()->with('error', 'Current password authentication failed!');
        }
    }
}
