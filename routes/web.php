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
Route::get('login-admin',	'GuestController@loginAdmin')
		->name('login.admin');
Route::get('login-author',	'GuestController@loginAuthor')
		->name('login.author');

Auth::routes();
Route::get('/dashboard',	'DashboardController@index')
		->name('dashboard');

# Guest and Author
// Account Request
Route::get('/account-registration', 
		'RegisterController@viewRegistrationForm');
Route::post('/account-registration', 
		'RegisterController@registerUser');

# Administrator and Author
// Notification
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
		Route::namespace('Admin')->group(function () {
			// Notifications
			Route::get('notification/{id}/read', 
					'NotificationController@readNotif');		
			Route::get('notification/read-all', 
					'NotificationController@readAll')
				->name('readAllMark');
			Route::get('notifications', 
				'NotificationController@viewNotifications')
				->name('admin.notifications');
			// Schedule
			Route::get('schedule/today', 
				'ScheduleController@listTodaySchedule')
				->name('admin.today');
		});

		Route::get('dashboard', 'DashboardController@index');
		Route::get('calendar', function(){
			return view('admin.calendar');
		})->name('admin.calendar');
		Route::get('mails', function() {
			return view('admin.mail');
		});
		Route::get('user-profile', function(){
			return view('admin.user-profile');
		});
		
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
					Route::get('project/{id}/{deptId}',		
							'ProjectController@viewProject');
					Route::put('project/{id}/{deptId}/edit', 
							'ProjectController@updateProject');
					// Requirements maintenance
					Route::get('requirements', 
							'RequirementController@maintainRequirements')
							->name('maintenance.requirements');
					Route::post('requirements', 
							'RequirementController@addRequirement');
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
					# Author account 
					Route::get('author/account-requests', 
						'RegisterAuthorController@listAccountRequests');
					Route::get('author/account-request/{id}/approved', 
						'RegisterAuthorController@approveAccountRequest');
					Route::get('author/account-request/{id}', 
						'RegisterAuthorController@viewAccountRequest');
					Route::post('author/account-requests/message', 
						'RegisterAuthorController@messageAuthor');

					# Copyright
					// Pending requests
					Route::get('copyrights/pend-request', 
						'PendRequestController@listPendingCopyrightRequest');
					Route::get('copyright/pend-request/{id}', 
						'PendRequestController@viewPendingCopyrightRequest');
					// To submit
					Route::get('copyrights/to-submit', 
						'ToSubmitController@listToSubmitCopyrightRequest');
					Route::get('copyright/to-submit/{id}', 
						'ToSubmitController@viewToSubmitCopyrightRequest');
					// On process
					Route::get('copyrights/on-process', 
						'OnProcessController@listOnProcessCopyrightRequest');
					Route::get('copyright/on-process/{id}', 
						'OnProcessController@viewOnProcessCopyrightRequest');
					
					# Patent
					// Pending requests
					Route::get('patents/pend-request', 
						'PendRequestController@listPendingPatentRequest');
					Route::get('patent/pend-request/{id}', 
						'PendRequestController@viewPendingPatentRequest');
					Route::get('same-sched/{id}', 
							'PendRequestController@cloneCopyrightAppointment');
					// To submit
					Route::get('patents/to-submit', 
						'ToSubmitController@listToSubmitPatentRequest');
					Route::get('patent/to-submit/{id}', 
						'ToSubmitController@viewToSubmitPatentRequest');
					// On process
					Route::get('patents/on-process', 
						'OnProcessController@listOnProcessPatentRequest');
					Route::get('patent/on-process/{id}', 
						'OnProcessController@viewOnProcessPatentRequest');
				});
				

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
			Route::get('ipr-patent-application/{id}',
					'IPRApplicationController@viewPatentApplication')
					->name('author.ipr-patent-application');
			Route::post('ipr-patent-application', 
				'IPRApplicationController@storePatentRequest');
			Route::get('my-projects', 
					'WorkController@myProjects')
					->name('author.my-projects');
			Route::get('my-project/{id}/{title}', 'WorkController@viewMyProject');	
			Route::get('guide', 
					'GuideController@viewGuide')
					->name('author.guide');

		});
		
			// // WORKING ON
			// Route::get('apply-patent-project', 
			// 	'Transaction\PendRequestController@viewPatentApplication');
			// Route::post('apply-patent-project', 
			// 	'Transaction\PendRequestController@storePatentRequest');
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