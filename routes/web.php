<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

# GUEST
Route::get('/', 			'GuestController@index');
Route::get('/about-us', 	'GuestController@about');

Auth::routes();
Route::get('/dashboard',	'DashboardController@index')->name('dashboard');

# ADMINISTRATOR
Route::group(
	[
		'prefix' => 'admin'
	],
	function()
	{
		Route::get('dashboard', 'DashboardController@index');
		Route::get('calendar', function(){
			return view('admin.calendar');
		});
		Route::get('mails', function() {
			return view('admin.mail');
		});
		Route::get('user-profile', function(){
			return view('admin.user-profile');
		});
		
		// Route::get('notification/{id}/read', 'NotificationController@readNotif');		
		// Route::get('notification/read-all', 'NotificationController@readAll')
		// 	->name('readAllMark');

		// Maintenance routes of Admin
		Route::group(
			[
				'prefix' => 'maintenance'
			], 
			function()
			{
				Route::namespace('Maintenance')->group(function () {
					// Branches maintenance
					Route::get('branches', 				'BranchController@maintainBranches');
					Route::post('branches', 			'BranchController@addBranch');
					Route::get('branch/{id}', 			'BranchController@viewBranch');
					Route::put('branch/{id}/edit', 		'BranchController@updateBranch');
					Route::delete('branch/{id}/delete',	'BranchController@deleteProfPic');
					// Colleges maintenance
					Route::get('colleges', 				'CollegeController@maintainColleges');
					Route::get('college/{id}', 			'CollegeController@viewCollege');
					Route::post('colleges', 			'CollegeController@addCollege');
					Route::put('college/{id}/edit', 	'CollegeController@updateCollege');
					// Departments maintenance
					Route::get('departments', 			'DepartmentController@maintainDepartments');
					Route::get('department/{id}', 		'DepartmentController@viewDepartment');
					Route::post('departments', 			'DepartmentController@addDepartment');
					Route::put('department/{id}/edit', 'DepartmentController@updateDepartment');	
					// Accounts maintenance
					Route::get('accounts', 				'AccountController@maintainAccounts');
					
					// Project types maintenance
					Route::get('project-types', 		'ProjectTypeController@maintainProjectTypes');
					Route::get('project-type/{id}', 	'ProjectTypeController@showProjectType');
					Route::post('project-types', 		'ProjectTypeController@addProjectType');
					Route::put('project-type/{id}', 	'ProjectTypeController@updateProjectType');
					// Projects maintenance
					Route::get('projects',				'ProjectController@maintainProjects');
					Route::post('projects', 			'ProjectController@addProject');
					Route::get('project/{id}/{deptId}', 	'ProjectController@viewProject');
					Route::put('project/{id}/{deptId}/edit', 'ProjectController@updateProject');
				});
			}
		);
		
		// Records module
		Route::group(
			[
				'prefix' => 'records'
			],
			function()
			{
				Route::namespace('Records')->group(function(){
					Route::get('copyrights', 			'CopyrightController@listCopyrights');
					Route::get('copyright/{id}', 		'CopyrightController@viewCopyright');
					Route::get('patents', 				'PatentController@listPatents');	
					Route::get('patent/{id}', 			'PatentController@viewPatent');	
					Route::get('applicants', 			'ApplicantController@listApplicants');	
					Route::get('applicant/{id}', 		'ApplicantController@viewApplicant');	
				});
			}
		);
	}
);

// Query routes
// Route::get('/query', 'QueryController@index');

// // Report routes
// Route::get('/report', 'ReportController@index');

// Resources routes
// Route::resources([
// 	'account' => 'AccountController',
// 	'message' => 'MessageController',
// 	'copyright' => 'CopyrightController',
// 	'patent' => 'PatentController'
// ]);
