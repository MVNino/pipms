<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

# GUEST
// For lalay guest page test
Route::get('showThis', function(){
	return view('temp-index');
});

// For Admin Charts
Route::get('monthly-copyrights-patents', 
		'DashboardController@getMonthlyCopyrightPatents');
Route::get('monthly-copyrighted-patented', 
		'DashboardController@getMonthlyCopyrightedPatented');
Route::get('copyrights-for-this-month', 
		'DashboardController@copyrightsForThisMonth');
Route::get('patents-for-this-month', 
		'DashboardController@patentsForThisMonth');

Route::get('/', 'GuestController@index')
		->name('index');
Route::get('/copyrightable-works', 'GuestController@listCopyrightables')
		->name('copyrightables');
Route::get('/patentable-works', 'GuestController@listPatentables')
		->name('patentables');
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
			Route::get('notifications/read-all', 
					'NotificationController@readAll')
				->name('readAllMark');
			Route::get('notifications', 
				'NotificationController@viewNotifications')
				->name('admin.notifications');
			// Schedule
			Route::get('schedule-today', 
				'ScheduleController@listTodaySchedule')
				->name('admin.today');
			Route::put('schedule-today/{id}/conflict', 
				'ScheduleController@classifyToConflicts');
			Route::get('schedule-today/{id}/{ipr}/conflict', 
				'ScheduleController@getClassifyToConflicts');
			Route::get('mails', 'MailController@viewMails');
			Route::get('mails/{id}', 'MailController@viewMessage');
			Route::get('sent', 'MailController@Sent');
			Route::get('sent/{id}', 'MailController@viewSent');
			Route::post('my-mails', 'MailController@composeMails');
			Route::delete('mails/{id}', 'MailController@deleteMails');	
			Route::get('user-profile', 'ProfileController@viewUserProfile')
				->name('admin.user-profile');
			Route::put('{id}/update-profile-pic', 
				'ProfileController@updateProfilePic');
			Route::put('{id}/update-profile', 
				'ProfileController@updateUserProfile');
			Route::put('{id}/change-password', 
				'ProfileController@changePassword');
		});



		Route::get('dashboard', 'DashboardController@index');
		// Maintenance Module
		Route::group(
			[
				'prefix' => 'maintenance'
			], 
			function()
			{
				Route::namespace('Maintenance')->group(function () {
					// Branches maintenance
					Route::get('branches', 
							'BranchController@maintainBranches');
					Route::post('branches', 			
							'BranchController@addBranch');
					Route::get('branch/{id}', 			
							'BranchController@viewBranch');
					Route::put('branch/{id}/edit', 		
							'BranchController@updateBranch');
					Route::delete('branch/{id}/delete',	
							'BranchController@deleteProfPic');
					// Colleges maintenance
					Route::get('colleges', 				
							'CollegeController@maintainColleges');
					Route::get('college/{id}', 			
							'CollegeController@viewCollege');
					Route::post('colleges', 			
							'CollegeController@addCollege');
					Route::put('college/{id}/edit', 	
							'CollegeController@updateCollege');
					// Departments maintenance
					Route::get('departments', 			
							'DepartmentController@maintainDepartments');
					Route::get('department/{id}', 		
							'DepartmentController@viewDepartment');
					Route::post('departments', 			
							'DepartmentController@addDepartment');
					Route::put('department/{id}/edit',	
							'DepartmentController@updateDepartment');	
					// Accounts maintenance
					Route::get('accounts', 				
							'AccountController@maintainAccounts');
					Route::post('accounts', 'AccountController@addAnotherAdmin');
					// Project types maintenance
					Route::get('project-types', 		
							'ProjectTypeController@maintainProjectTypes');
					Route::get('project-type/{id}', 	
							'ProjectTypeController@showProjectType');
					Route::post('project-types', 		
							'ProjectTypeController@addProjectType');
					Route::put('project-type/{id}', 	
							'ProjectTypeController@updateProjectType');
					// Projects maintenance
					Route::get('projects',				
							'ProjectController@maintainProjects');
					Route::post('projects', 			
							'ProjectController@addProject');
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
					Route::get('requirement/{id}', 
							'RequirementController@viewRequirement');
					Route::put('requirement/{id}/edit', 
							'RequirementController@updateRequirement');
					
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
					Route::put('author/account-request/{id}/approved/put', 
						'RegisterAuthorController@approvePutAccountRequest');
					Route::get('author/account-request/{id}', 
						'RegisterAuthorController@viewAccountRequest');
					Route::post('author/account-requests/message', 
						'RegisterAuthorController@messageAuthor');

					# Copyright
					// Pending requests
					Route::get('copyrights/pend-request', 
						'PendRequestController@listPendingCopyrightRequest')
						->name('transaction.copyright-pending');
					Route::get('copyright/pend-request/{id}', 
						'PendRequestController@viewPendingCopyrightRequest');
					Route::put('copyright/set-schedule/{id}', 
						'PendRequestController@setSchedule');
					Route::get('copyrights/pend-request/id/college', function(){
						return view('admin.transaction.college-copyright-pending');
					});
					// To submit
					Route::get('copyrights/to-submit', 
						'ToSubmitController@listToSubmitCopyrightRequest')
						->name('transaction.copyright-to-submit');
					Route::get('copyright/to-submit/{id}', 
						'ToSubmitController@viewToSubmitCopyrightRequest');
					Route::put('copyright/to-submit/{id}/timer', 
						'ToSubmitController@toSubmitCopyrightTimer');
					Route::post('copyright/to-submit/incomplete', 
						'ToSubmitController@incompleteRequirements');
					Route::put('copyright/to-submit-to-on-process/{id}', 
						'ToSubmitController@changeStatusToOnProcess');
					// On process
					Route::get('copyrights/on-process', 
						'OnProcessController@listOnProcessCopyrightRequest')
						->name('transaction.copyright-on-process');
					Route::get('copyright/on-process/{id}', 
						'OnProcessController@viewOnProcessCopyrightRequest');
					Route::put('copyright/on-process-to-copyrighted/{id}', 
						'OnProcessController@changeStatusToCopyrighted');
					
					# Patent
					// Pending requests
					Route::get('patents/pend-request', 
						'PendRequestController@listPendingPatentRequest')
						->name('transaction.patent-pending');
					Route::get('patent/pend-request/{id}', 
						'PendRequestController@viewPendingPatentRequest');
					Route::put('same-sched/{id}', 
						'PendRequestController@cloneCopyrightAppointment');
					Route::put('patent/set-schedule/{id}', 
						'PendRequestController@setScheduleForPatent');
					Route::get('patents/pend-request/id/college', function(){
						return view('admin.transaction.college-patent-pending');
					});
					// To submit
					Route::get('patents/to-submit', 
						'ToSubmitController@listToSubmitPatentRequest')
						->name('transaction.patent-to-submit');
					Route::get('patent/to-submit/{id}', 
						'ToSubmitController@viewToSubmitPatentRequest');
					Route::put('patent/to-submit/{id}/timer', 
						'ToSubmitController@toSubmitPatentTimer');
					Route::post('patent/to-submit/incomplete', 
						'ToSubmitController@patentIncompleteRequirements');
					Route::put('patent/change-to-submit-to-on-process/{id}', 
						'ToSubmitController@changePatentStatusToOnProcess');
					// On process
					Route::get('patents/on-process', 
						'OnProcessController@listOnProcessPatentRequest')
						->name('transaction.patent-on-process');
					Route::get('patent/on-process/{id}', 
						'OnProcessController@viewOnProcessPatentRequest');
					Route::put('patent/change-on-process-to-patented/{id}', 
						'OnProcessController@changeStatusToPatented');
				});
				
				Route::get('copyrights/initial-request', 
					'TransactionController@listInitialRequests');

				Route::get('copyright/initial-request/{id}/approve', 
					'TransactionController@approveInitialRequest');
			}
		);

		# Query Module
		Route::get('queries', 'QueryController@index')->name('queries');

		# Reports Module
		Route::group(
			[
				'prefix' => 'reports'
			],
			function()
			{
				Route::namespace('Report')->group(function(){
					Route::get('copyright',	
						'CopyrightController@listCopyrights')
						->name('reports.copyright');
					Route::get('copyrighted/{id}', 		
						'CopyrightController@viewCopyright');
					Route::get('copyrights/range-date', 
						'CopyrightController@rangedCopyrights');

					// Copyright Report PDF
					//All
					Route::get('copyrights/copyrights_pdf', 
						'CopyrightController@copyrightsPDF')
						->name('copyrights-pdf');
					Route::get('copyrights/{start}/{end}/copyrights_pdf', 
						'CopyrightController@rangedCopyrightsPDF');
					// Pending
					Route::get('copyrights/pending_copyrights_pdf', 
						'CopyrightController@pendingCopyrightsPDF')
						->name('copyright.pending-pdf');
					Route::get('copyrights/{start}/{end}/pending_copyrights_pdf', 
						'CopyrightController@rangedPendingCopyrightsPDF');
					// To Submit
					Route::get('copyrights/to_submit_copyrights_pdf', 
						'CopyrightController@toSubmitCopyrightsPDF')
						->name('copyright.to-submit-pdf');
					Route::get('copyrights/{start}/{end}/to_submit_copyrights_pdf', 
						'CopyrightController@rangedToSubmitCopyrightsPDF');
					// On Process
					Route::get('copyrights/on_process_copyrights_pdf', 
						'CopyrightController@onProcessCopyrightsPDF')
						->name('copyright.on-process-pdf');
					Route::get('copyrights/{start}/{end}/on_process_copyrights_pdf', 
						'CopyrightController@rangedOnProcessCopyrightsPDF');
					// Copyrighted
					Route::get('copyrights/copyrighted_pdf', 
						'CopyrightController@copyrightedPDF')
						->name('copyrighted-pdf');
					Route::get('copyrights/{start}/{end}/copyrighted_pdf', 
						'CopyrightController@rangedCopyrightedPDF');

					# Patent
					Route::get('patent', 		
						'PatentController@listPatents')
						->name('reports.patent');	
					Route::get('patented/{id}', 			
						'PatentController@viewPatent');
					Route::get('patents/range-date', 
						'PatentController@rangedPatents');
					// Patent Report PDF
					//All
					Route::get('patents/patents_pdf', 
						'PatentController@patentsPDF')
						->name('patents-pdf');
					Route::get('patents/{start}/{end}/patents_pdf', 
						'PatentController@rangedPatentsPDF');
					// Pending
					Route::get('patents/pending_patents_pdf', 
						'PatentController@pendingPatentsPDF')
						->name('patent.pending-pdf');
					Route::get('patents/{start}/{end}/pending_patents_pdf', 
						'PatentController@rangedPendingPatentsPDF');
					// To Submit
					Route::get('patents/to_submit_patents_pdf', 
						'PatentController@toSubmitPatentsPDF')
						->name('patent.to-submit-pdf');
					Route::get('patents/{start}/{end}/to_submit_patents_pdf', 
						'PatentController@rangedToSubmitPatentsPDF');
					// On Process
					Route::get('patents/on_process_patents_pdf', 
						'PatentController@onProcessPatentsPDF')
						->name('patent.on-process-pdf');
					Route::get('patents/{start}/{end}/on_process_patents_pdf', 
						'PatentController@rangedOnProcessPatentsPDF');
					// Patented
					Route::get('patents/patented_pdf', 
						'PatentController@patentedPDF')
						->name('patented-pdf');
					Route::get('patents/{start}/{end}/patented_pdf', 
						'PatentController@rangedPatentedPDF');

					Route::get('author', 		
						'AuthorController@listApplicants')
						->name('reports.author');	
					Route::get('author/{id}', 		
						'AuthorController@viewApplicant');
					Route::get('authors/range-date', 
						'AuthorController@rangedAuthors');
					// Author Report PDF
					Route::get('author/authors_pdf', 
						'AuthorController@authorsPDF')
						->name('authors-pdf');
					Route::get('author/{start}/{end}/authors_pdf', 
						'AuthorController@rangedAuthorsPDF');

					# Application Issue
					Route::get('application-issues', 
						'ApplicationIssueController@listApplicationIssues')
						->name('reports.application-issues');
					Route::get('application-issues/range-date', 
						'ApplicationIssueController@rangedApplicationIssues');
					// Issues PDF
					Route::get('application-issues_pdf', 
						'ApplicationIssueController@issuesPdf')
						->name('reports.application-issues');
					Route::get('application-issues_pdf/{start}/{end}', 
						'ApplicationIssueController@issuesPdf');

					# Branches Report
					Route::get('branches', 
						'BranchController@listBranches')
						->name('reports.branches');
					Route::get('branches/range-date', 
						'BranchController@rangedBranches');
					Route::get('branch/{id}', 
						'BranchController@viewBranch');
					Route::get('branch/{id}/range-date/{start}/{end}', 
						'BranchController@viewRangedBranch');

					// Branch Chart Report
					Route::get('branch/{id}/branch_ipr_chart_report', 
						'BranchChartController@getBranchMonthlyChart');

					// Branch Report PDF
					// Copyrights of College
					Route::get('branch/{id}/copyrights_pdf', 
						'BranchController@copyrightsPDF');
					Route::get('branch/{id}/{start}/{end}/copyrights_pdf', 
						'BranchController@copyrightsPDF');
					// Patents of branch
					Route::get('branch/{id}/patents_pdf', 
						'BranchController@patentsPDF');
					Route::get('branch/{id}/{start}/{end}/patents_pdf', 
						'BranchController@patentsPDF');
					// Branch stats PDF
					Route::get('branches_pdf', 
						'BranchController@branchesPDF')
						->name('branches-pdf');
					Route::get('branch/{start}/{end}/branches_pdf', 
						'BranchController@rangedBranchesPDF');
					// Branch-College Mini Stats PDF
					Route::get('branch/{id}/branch-colleges_pdf', 
						'BranchController@branchColPdf');
					// Branch IPR Issues PDF
					Route::get('branch/{id}/ipr-conflicts_pdf/{conflict}', 
						'BranchController@iprConflictsPdf');
					Route::get('branch/{id}/ipr-conflicts_pdf/{conflict}', 
						'BranchController@iprConflictsPdf');

					# Colleges Report
					Route::get('colleges', 
						'CollegeController@listColleges')
						->name('reports.colleges');
					Route::get('colleges/range-date', 
						'CollegeController@rangedColleges');
					Route::get('college/{id}', 
						'CollegeController@viewCollege');
					Route::get('college/{id}/range-date/{start}/{end}', 
						'CollegeController@viewRangedCollege');

					// College Chart Report
					Route::get('college/{id}/college_monthly_ipr', 'CollegeChartController@IPRMonthlyStats');
					Route::get('college/{id}/college_ipr_chart_report', 
						'CollegeChartController@getCollegeMonthlyChart');
					Route::get('college/{id}/college_branch_ipr_chart_report', 
						'CollegeChartController@getCopyrightContributionsToItsBranchChart');

					// College Report PDF
					// Copyrights of College
					Route::get('college/{id}/copyrights_pdf', 
						'CollegeController@copyrightsPDF');
					Route::get('college/{id}/{start}/{end}/copyrights_pdf', 
						'CollegeController@copyrightsPDF');
					// Patents of College
					Route::get('college/{id}/patents_pdf', 
						'CollegeController@patentsPDF');
					Route::get('college/{id}/{start}/{end}/patents_pdf', 
						'CollegeController@patentsPDF');
					// College Stats PDF
					Route::get('colleges_pdf', 
						'CollegeController@collegesPDF')
						->name('colleges-pdf');
					Route::get('college/{start}/{end}/colleges_pdf', 
						'CollegeController@rangedCollegesPDF');
					// College-Departments Mini Stats PDF
					Route::get('college/{id}/college-departments_pdf', 
						'CollegeController@collegeDeptPdf');
					// College IPR Issues PDF
					Route::get('college/{id}/ipr-conflicts_pdf/{conflict}', 
						'CollegeController@iprConflictsPdf');
					Route::get('college/{id}/ipr-conflicts_pdf/{conflict}', 
						'CollegeController@iprConflictsPdf');


					# Departments Report
					Route::get('departments', 
						'DepartmentController@listDepartments')
						->name('reports.departments');
					Route::get('departments/range-date', 
						'DepartmentController@rangedDepartments');
					Route::get('department/{id}', 
						'DepartmentController@viewDepartment');
					Route::get('department/{id}/range-date/{start}/{end}', 
						'DepartmentController@viewRangedDepartment');

					// Department Chart Report
					Route::get('department/{id}/department_ipr_chart_report', 
						'DepartmentChartController@getDepartmentMonthlyChart');
					Route::get('department/{id}/department_college_ipr_chart_report', 
						'DepartmentChartController@getCopyrightContributionsToItsCollegeChart');

					// Department Report PDF
					// Copyrights of College
					Route::get('department/{id}/copyrights_pdf', 
						'DepartmentController@copyrightsPDF');
					Route::get('department/{id}/{start}/{end}/copyrights_pdf', 
						'DepartmentController@copyrightsPDF');
					// Patents of department
					Route::get('department/{id}/patents_pdf', 
						'DepartmentController@patentsPDF');
					Route::get('department/{id}/{start}/{end}/patents_pdf', 
						'DepartmentController@patentsPDF');
					// Departments Stats PDF
					Route::get('departments_pdf', 
						'DepartmentController@departmentsPDF')
						->name('departments-pdf');
					Route::get('department/{start}/{end}/departments_pdf', 
						'DepartmentController@rangedDepartmentsPDF');
				});
			}
		);
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
			// Notifications
			Route::get('notification/{id}/read', 
				'NotificationController@readNotif');		
			Route::get('notifications/read-all', 
				'NotificationController@readAll')
				->name('author.readAllMark');
			Route::get('notifications', 
				'NotificationController@viewNotifications')
				->name('author.notifications');

			Route::get('mails', 'MailController@viewMyMails')
				->name('author.mails');
			Route::get('mails/{id}', 'MailController@viewMyMessage');

			Route::get('sent', 'MailController@MySent');
			Route::get('sent/{id}', 'MailController@viewMySent');
			Route::post('my-mails', 'MailController@composeMails');
			Route::post('mails', 'MailController@replyMails');
			Route::delete('mails/{id}', 'MailController@deleteMails');

			// Profile
			Route::get('user-profile', 
				'ProfileController@viewProfile')
				->name('author.profile');
			Route::get('branch-colleges/{branchId}', 
				'ProfileController@extractColleges');
			Route::get('college-departments/{collegeId}', 
				'ProfileController@extractDepartments');
			Route::put('{id}/edit-account', 
				'ProfileController@updateAuthor');
			Route::put('{id}/update-profile-pic', 
				'ProfileController@updateProfilePic');
			// IPR Application
			Route::get('ipr-application', 
				'IPRApplicationController@viewIPRApplication')
				->name('author.ipr-application');
			Route::post('ipr-application', 
				'IPRApplicationController@storeCopyrightRequest');
			Route::get('ipr-patent-application/{id}/{title}',
				'IPRApplicationController@viewPatentApplication')
				->name('author.ipr-patent-application');
			Route::post('ipr-patent-application', 
				'IPRApplicationController@storePatentRequest');
			Route::get('my-projects', 
				'WorkController@myProjects')
				->name('author.my-projects');
			Route::get('my-project/{id}/{title}', 
				'WorkController@viewMyProject');	
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
	// author registration
	Route::get('/registration/author/{id}/form/{token}', 
		'RegisterAuthorController@authorAccountRegistration');
	// author revision of author account request
	Route::get('/registration/author/{id}/revision-form/{token}', 
		'RegisterAuthorController@authorAccountRequestRevision');

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