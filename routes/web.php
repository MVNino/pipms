<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

# GUEST
Route::get('/', 'GuestController@index')
		->name('index');
Route::get('/about-us', 'GuestController@about')
		->name('about-us');
Route::get('/application/guide', 'GuestController@viewApplicationGuide')
		->name('application.guide');

// Login Authentication
Route::get('admin-login',	'GuestController@loginAdmin');
Route::get('author-login',	'GuestController@loginAuthor');

Auth::routes();
Route::get('/dashboard',	'DashboardController@index')
		->name('dashboard');

# Guest && Author
// Account Request
Route::get('/account-registration', 
		'RegisterController@viewRegistrationForm');
Route::post('/account-registration', 
		'RegisterController@registerUser');

# ADMINISTRATOR && AUTHOR
// Notif
Route::get('notification/{id}/read', 'NotificationController@readNotif');		
Route::get('notification/read-all', 'NotificationController@readAll')
	->name('readAllMark');

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
		
		// Route::get('notification/{id}/read', 
				// 'NotificationController@readNotif');		
		// Route::get('notification/read-all', 
				// 'NotificationController@readAll')
		// 	->name('readAllMark');

		// Maintenance Module
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
					Route::get('project/{id}/{deptId}',		'ProjectController@viewProject');
					Route::put('project/{id}/{deptId}/edit', 'ProjectController@updateProject');
				});
			}
		);
		
		// Transaction module
		Route::group(
			[
				'prefix' => 'transaction'
			],
			function()
			{
				Route::namespace('Transaction')->group(function(){
					Route::get('author/account-requests', 
						'RegisterAuthorController@listAccountRequests');
					Route::get('author/account-request/{id}/approved', 
						'RegisterAuthorController@approveAccountRequest');
					Route::get('author/account-request/{id}', 
						'RegisterAuthorController@viewAccountRequest');
					Route::post('author/account-requests/message', 'RegisterAuthorController@messageAuthor');
				});
				
				// Copyright
				Route::get('copyrights/pend-request', 
					'TransactionController@listPendingCopyrightRequest');
				Route::get('copyright/pend-request/{id}', 
					'TransactionController@viewPendingCopyrightRequest');
				Route::get('copyrights/to-submit', 
					'TransactionController@listToSubmitCopyrightRequest');
				Route::get('copyright/to-submit/{id}', 
					'TransactionController@viewToSubmitCopyrightRequest');
				Route::get('copyrights/on-process', 
					'TransactionController@listOnProcessCopyrightRequest');
				Route::get('copyright/on-process/{id}', 
					'TransactionController@viewOnProcessCopyrightRequest');

				// Patent
				Route::get('patents/pend-request', 
					'TransactionController@listPendingPatentRequest');
				Route::get('patent/pend-request/{id}', 
					'TransactionController@viewPendingPatentRequest');
				Route::get('patents/to-submit', 
					'TransactionController@listToSubmitPatentRequest');
				Route::get('patent/to-submit/{id}', 
					'TransactionController@viewToSubmitPatentRequest');
				Route::get('patents/on-process', 
					'TransactionController@listOnProcessPatentRequest');
				Route::get('patent/on-process/{id}', 
					'TransactionController@viewOnProcessPatentRequest');

				Route::post('copyrights/message', 'TransactionController@messageApplicant');
				Route::get('copyright/{id}/up', 'TransactionController@upStatus');
			
				Route::put('copyright/set-schedule/{id}', 
					'TransactionController@setSchedule');
				Route::get('copyright/change-to-submit-to-on-process/{id}', 
					'TransactionController@changeStatusToOnProcess');
				Route::get('copyright/change-on-process-to-copyrighted/{id}', 
					'TransactionController@changeStatusToCopyrighted');

				Route::put('patent/set-schedule/{id}', 
					'TransactionController@setScheduleForPatent');
				Route::get('patent/change-to-submit-to-on-process/{id}', 
					'TransactionController@changePatentStatusToOnProcess');
				Route::get('patent/change-on-process-to-patented/{id}', 
					'TransactionController@changePatentStatusToPatented');


				Route::get('copyrights/initial-request', 
					'TransactionController@listInitialRequests');

				Route::get('copyright/initial-request/{id}/approve', 
					'TransactionController@approveInitialRequest');

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

		# Query Module
		// Route::get('/query', 'QueryController@index');

		# Report Module
		// Route::get('/report', 'ReportController@index');
	}
);

# AUTHOR
Route::group(
	[
		'prefix' => 'author'
	],
	function() 
	{
		Route::get('same-sched/{id}', 
				'TransactionController@cloneCopyrightAppointment');
		# Transaction - Author
		Route::namespace('Author')->group(function(){
			Route::get('dashboard', 
					'DashboardController@pdDashboard')
					->name('author.dashboard');
			Route::get('mails', 
					'MailController@viewMails')
					->name('author.mails');
			Route::get('user-profile', 
					'ProfileController@viewProfile')
					->name('author.profile');
			Route::put('edit-account/{id}', 
					'ProfileController@updateAuthor');
			Route::get('ipr-application', 
					'IPRApplicationController@viewIPRApplication')
					->name('author.ipr-application');
			Route::post('ipr-application', 
				'IPRApplicationController@storeCopyrightRequest');
			Route::get('my-projects', 
					'WorkController@viewMyProjects')
					->name('author.my-projects');
			Route::get('guide', 
					'GuideController@viewGuide')
					->name('author.guide');			
		});
		
			// WORKING ON
			Route::get('apply-patent-project', 
				'PendRequestController@viewPatentApplication');
			Route::post('apply-patent-project', 
				'PendRequestController@storePatentRequest');
	}
);

// Author - Account Request Transaction
Route::namespace('Transaction')->group(function(){
	Route::get('/registration/author', 'RegisterAuthorController@showRegistrationForm');
	Route::get('/registration/author/new', function(){
		return view('guest.author-account-request');
	});
	Route::post('/registration/author', 'RegisterAuthorController@requestAuthorAccount');
	Route::get('/registration/author/{id}/form/{token}', 
		'RegisterAuthorController@authorAccountRegistration');
	Route::put('/registration/author/{id}/form', 
		'RegisterAuthorController@grantAuthorAccount');
});

# Resources routes
// Route::resources([
// 	'account' => 'AccountController',
// 	'message' => 'MessageController',
// 	'copyright' => 'CopyrightController',
// 	'patent' => 'PatentController'
// ]);

# Sample
Route::get('/paper-kit2', function(){
	return view('paper-kit2');
});