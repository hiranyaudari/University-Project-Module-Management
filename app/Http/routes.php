<?php

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

//App\Http\Controllers\notificationController::GetAllUnreadNotification();

Route::get('/', 'WelcomeController@index');

//Route::controllers([
//    'auth' => 'Auth\AuthController',
////	'password' => 'Auth\PasswordController',
//]);
//Route::get('report','ReportController@index');////////////////////////////////////////////////////////////////////////////////////////
//Route::get('reportfile','fileController@view');
//Route::post('report','ReportController@add');/////////////////////////////////////////////////////////////////////////////////
//Route::get('reportfile', 'viewcontroller@ind');//////////////////////////////////////////////////////////////////////////////////////

Route::get('feed', 'viewcontroller@fb');

Route::post('feed', 'feedController@addfeed');
Route::get('test33', 'projectController@test');

//notification
Route::get('/viewSupervisorDetails/{projectId}/{id}', 'notificationController@showRpcNotification');
//Route::get('actionExternalSupervisor/{supervisorid}','notificationController@accept');
//Route::get('rejectsExternalSupervisor/{supervisorid}','notificationController@reject');


Route::group(array('middleware' => 'auth'), function() {
    Route::get('logout', 'AuthenticationController@logout');
});

Route::group(array('middleware' => 'guest', 'middleware' => 'rpc'), function() {


    //ajax route for shifting the slot of the projects for thesis presentation
    Route::get('getprojectdetail/{id}', 'ThesisPanelController@getProjectDetail');

    //ajax route for shifting the slot of the projects for thesis presentation
    Route::put('updatethesisslot/{id}', 'ThesisPanelController@updateSchedule');

    //ajax route for getting the projects for thesis presentation
    Route::get('getthesisprojects', 'ThesisPanelController@getThesisProjects');

    //ajax route for checking role of supervisor
    Route::get('getavailablemembers', 'ThesisPanelController@getAvailableMembers');

    //ajax route for checking role of supervisor
    Route::get('checkIfRPC', 'ThesisPanelController@checkIfRPC');

    //manage thesispresentations in calendar view
    Route::get('thesispanels/calendar/add', 'ThesisPanelController@showThesisPresentationCalendar');

    //route for downloading pdf for schedules
    Route::get('thesispanels/schedules/pdf', 'ReportGeneratorController@generateThesisSchedulesReports');

    //view thesis presentation slots in calendar view
    Route::get('thesispanels/calendar', 'ThesisPanelController@showCalendar');
    //thesis panel management
    Route::resource('thesispanels', 'ThesisPanelController');

    //delete thesis panel
    Route::resource('deletethesispanels', 'ThesisPanelController@destroy');


    //proposal panel management
    Route::resource('proposalpanels', 'PanelController');

    //ajax route for getting freeslots of supervisor
    Route::get('getsupervisor', 'PanelController@getSupervisor');
    //ajax route for getting freeslots of panelmember
    Route::get('member1', 'PanelController@getPanelMember1');

    Route::get('updateUser', 'createUserController@updateUserindex');
    Route::get('saveUpdatedUser', 'createUserController@updateUserindexstore');

    Route::get('/searchUser', 'createUserController@search');
    
    Route::get('addUser', 'createUserController@index');
    Route::get('/addUserNewAccount', 'createUserController@storeUser');

    Route::get('updateExternalSupervisor', 'SupervisorController@updateSupindex');
    Route::get('updateExternalSupervisorSearch', 'SupervisorController@search');
    Route::get('updateExternalSupervisorUpdate', 'SupervisorController@updateUserindexstore');
    Route::post('updateExternalSupervisorDelete', 'SupervisorController@deleteSup');
    Route::post('ViewPendingProjects', 'RPCController@approveRejectProjects'); //
    Route::get('viewExternalSupervisorProject', 'RPCController@viewExternalSupervisorProjects');
    Route::get('externalSupervisorIDetail/{username}', 'RPCController@viewExternalSupervisorDetails'); //----------------
    Route::get('studentDetails/{id}', 'RPCController@viewStudentDetails'); //---------------------
    Route::get('viewAllPanelmembers', 'RPCController@viewAllPanelmembers');
    Route::get('projectDetail/{id}', 'RPCController@viewProjectDetails'); //--------
    Route::get('approvedExternalSupervisors', 'RPCController@viewAllExternalSupervisors');
    Route::get('allProjects', 'RPCController@viewAllProjects');
    Route::get('rejectedSupervisors', 'RPCController@rejectedSupervisors');

    Route::post('viewNotice', 'NoticeController@notice_buttons');
    Route::get('viewNotice', 'NoticeController@viewLink');

    Route::get('addNotice', 'NoticeController@add_new_notice');
    Route::post('addNotice', 'NoticeController@addNotice');
  
    //harsha added
    Route::get('addResearchArea', 'AddResearchArea@add_research_area');
    Route::post('addResearchArea', 'AddResearchArea@storeResearchArea');

    Route::resource('DELETE', 'AddResearchArea@destroy');
    Route::get('DELETE/{id}', 'AddResearchArea@destroy');

    //Route::resource('addResearchArea/{id}', 'AddResearchArea@destroy');
    
    //evaluationform routes added by harsha///////////////////////////////
    Route::get('evaluationform', 'EvaluationController@create');
    Route::get('/searchstudent', 'createUserController@searchforStudents');
    
    Route::get('formsupervisor', 'supervisorevaluation@create');
    
    
    Route::get('editNotice/{id}', 'NoticeController@editNoticeView'); //------------------
    Route::post('editNotice/{id}', 'NoticeController@editNotice'); //--------------
    //notification
    Route::get('/viewSupervisorDetails/{projectId}/{notificationId}/{id}', 'notificationController@showRpcNotification');
    Route::get('/addSupervisorForProject', 'SupervisorController@SupervisorController');

    Route::get('/viewProjectDetails/{studentId}/{notificationId}/{projectId}', 'projectController@showSpecificProjectDet');
    Route::get('/UnreadNotification', 'notificationController@UnreadNotification');
    Route::get('/confirmForSupervisor/{projectID}/{notificationID}/{InternalSupervisorId}', 'SupervisorController@confirmSupervisorRegistration');
    Route::get('/ExternalSupervisorConfirmView', 'SupervisorController@confirmproject');
//download requestedProject Details
    Route::get('/downloadRequestedProject/{filename}', 'projectController@downloadRequestedProject');
//external Supervisor Confirmation link
    Route::get('/externalSupervisorConfirmation/{stuentId}/{projectId}', 'projectController@externalSupervisorConfirmation');

//Accept Supervisor
    Route::get('/acceptExternalSupervisor', 'SupervisorController@AcceptExternalSupervisor');
//Reject Supervisor
    Route::get('/RejectExternalSupervisor', 'SupervisorController@RejectExternalSupervisor');
//accept requested Project
    Route::get('/acceptProject', 'projectController@AcceptProject');

//accept requested Project
    Route::get('/rejectProject', 'projectController@RejectProject');
    Route::get('rpcdashboard', 'RPCController@showDashboard');
    Route::get('/ExternalSup', 'SupervisorController@create');
    Route::post('ExternalSup', ['as' => 'RegSup_store', 'uses' => 'SupervisorController@store']);
    Route::get('changeSup', 'SupervisorController@changeSupervisors');
    Route::get('/changeSupStore', 'SupervisorController@changeSupervisorsstore');
    Route::get('/viewProjectByProjectName', 'projectController@getProjectDetailsByName');
    Route::get('/acceptInternalSupervisorForProject', 'projectController@acceptInternalSupervisorForProject');
    Route::get('/rejectInternalSupervisorForProject', 'projectController@rejectInternalSupervisorForProject');
    Route::get('changeSupervisorRequest', 'RPCController@viewChangeRequestDetails');
    Route::get('changeSupervisorRequest/Reject/{id}', 'RPCController@Reject');
    Route::get('changeSupervisorRequest/Approve/{id}', 'RPCController@Approve');
    Route::post('changeSupervisorRequest', 'RPCController@filterSearch');
    Route::get('email/{mail}', 'RPCController@composeEmail');
    Route::post('email/{mail}', 'RPCController@sendEmail');

    Route::get('form', 'thesisEvaluationController@editThesisForm');
    Route::post('form', 'thesisEvaluationController@editThesisFormMarks');

    Route::get('viewInternalProjects', 'thesisEvaluationController@viewInternalThesisEvaluation');
    Route::get('viewInternalProjects/publish', 'thesisEvaluationController@publishStatus');

    Route::get('viewInternalProposals/publish', 'RPCProposalEvaluationController@publishStatus');
    Route::post('viewInternalProposals', 'RPCProposalEvaluationController@filterSearch');
    Route::get('viewInternalProposals', 'RPCProposalEvaluationController@viewInternalProposalEvaluation');

//    Route::get('addFreeSlot', 'FreeSlotController@store');
    Route::get('searchedFreeSlotDetails', 'FreeSlotController@getFreeSlotDetailsByEmail');
    Route::get('test6666', 'FreeSlotController@store');
    Route::get('/viewSupervisors', 'profileController@selectSupervisor');
    Route::get('/viewSupProfile', 'profileController@viewPanelMemberInfo');

    Route::get('/profile', 'profileController@selectSupervisor');
    Route::post('/profile', 'profileController@viewProfile');

    Route::post('viewSubmissions', 'submissionsController@selectSubmissions');
    Route::get('viewSubmissions', 'submissionsController@viewSubmissionsDetails');

    Route::get('viewLink', 'uploadController@viewLinks');
    Route::post('viewLink', 'uploadController@buttonActions');
    Route::get('editLink/{linkId}', 'uploadController@editLink');
    Route::post('editLink/{linkId}', 'uploadController@updateLinkDetails');
    Route::get('viewdoc/{supId}', 'submissionsController@viewDocuments');

    Route::get('upload', 'uploadController@uploadLink');
    Route::post('upload', 'uploadController@createUploadLink');
});
Route::get('RPCViewOwnProject', 'RPCController@viewOwnProjects');

Route::get('freeSlotManager', 'FreeSlotController@index');
Route::get('freeSlotManagerload', 'FreeSlotController@load');
Route::get('/deleteAllFreeSlot', 'FreeSlotController@deleteAllFreeSlots');
Route::get('/addFreeSlot', 'FreeSlotController@store');
Route::get('/deleteFreeSlot', 'FreeSlotController@deleteSlot');

Route::get('/updateFreeSlot', 'FreeSlotController@updateSpecificFreeSlot');
Route::get('/searchSpecificFreeSlot', 'FreeSlotController@searchSpecificSlot');
Route::get('/searchSpecificFreeSlotByDate', 'FreeSlotController@searchSpecificSlotByDate');
Route::get('viewProjects/{supId}', 'SupervisorController@viewProjects');
Route::group(array('middleware' => 'guest', 'middleware' => 'panelmember'), function() {

    //resourceful controller route for monthly reports
    Route::resource('monthlyreports/supervisor', 'SupervisorMonthlyReportController');

    //ajax route to load the projects into supervisor form
    Route::get('ajax/monthlyreports/getprojects', 'SupervisorMonthlyReportController@getProjects');

    //ajax route to load the monthly report
    Route::get('ajax/monthlyreports/getmonthlyreport', 'SupervisorMonthlyReportController@getMonthlyReport');

    //dashboards
    Route::get('panelmemberdashboard', 'PanelMemberController@showDashboard');

    //download requestedProject Details
//    Route::get('/downloadRequestedProject/{filename}','projectController@downloadRequestedProject');
//view Specific Project Details
    Route::get('/viewProjectDetails/{studentId}/{projectId}', 'projectController@showSpecificProjectDet');

    Route::get('/projectPool/{supId}', 'projectController@showProjectPool');
    Route::post('/projectPool/{supId}', 'projectController@selectProjectPool');
    
    ///////////////////////////harsha////////////
    Route::any('propevaluation', 'supevaluationController@create');
    Route::any('srsevaluation', 'supevaluationController@srscreate');
    Route::any('protoevaluation', 'supevaluationController@protocreate');
    Route::any('midevaluation', 'supevaluationController@midcreate');
    
    
    Route::get('thesisPresentations', 'thesisEvaluationController@viewPresentations');
    Route::get('thesisEvaluationForm/{id}', 'thesisEvaluationController@viewThesisForm');
    Route::post('thesisEvaluationForm/{id}', 'thesisEvaluationController@evaluate');
    Route::get('editThesis/{id2}', 'thesisEvaluationController@editThesisEvaluation');
    Route::post('editThesis/{id2}', 'thesisEvaluationController@editForm');

    Route::get('ProposalEvaluationPresentations', 'ProposalEvaluationController@viewProposalPresentation');
    Route::get('proposalEvaluationForm/{id}', 'ProposalEvaluationController@addProposalEvaluation');
    Route::post('proposalEvaluationForm/{id}', 'ProposalEvaluationController@next');
    Route::get('editProposal/{id2}', 'ProposalEvaluationController@editProposalEvaluation');
    Route::post('editProposal/{id2}', 'ProposalEvaluationController@next_edit');
    Route::get('proposalEvaluationForm', 'ProposalEvaluationController@viewForm');
    Route::get('AcceptOrRejectSupervisorMeetingRequest', 'EventController@AcceptOrReject');
    Route::get('/RequestSupervisorAsYou/{projectID}/{notificationID}/{studentId}', 'SupervisorController@RequestSupervisorAsPanelMember');
    Route::post('downloadthesis', 'reportcontroller@viewReport');
    Route::get('interimrpt/get/{filename}', array('as' => 'getentry', 'uses' => 'reportcontroller@get'));
    Route::get('interimfeed', 'reportController@viewFeedback');
    Route::post('interimfeed', 'reportController@addFeedback');
    Route::get('studentinfo', 'reportController@studentInfo');
    Route::post('studentinfo', 'reportController@viewStudentDetails');
    Route::get('downloadthesis', 'reportController@downloadThesis');
});

Route::group(array('middleware' => 'guest', 'middleware' => 'student'), function() {

    //view supervisor feedbacks
    Route::get('monthlyreports/student/feedbacks', 'StudentMonthlyReportController@showFeedbacks');

    //resourceful controller route for monthly reports
    Route::resource('monthlyreports/student', 'StudentMonthlyReportController');
    Route::get('studentdashboard', 'StudentController@showDashboard');
    Route::get('viewNoticesForStudent', 'NoticeController@viewLinksForStudent');

    Route::get('Students', 'studentController@view_student'); //this is for stuent view
    Route::get('download/{filename}', 'studentController@downloadFile');
    Route::get('view1/{filename1}', 'studentController@viewpdffile');

    Route::get('changeSupervisor', 'StudentController@viewChangeSupervisorForm');
    Route::post('changeSupervisor', 'StudentController@insertChangeSupervisorDetails');
    Route::get('studentDetails/{name}', 'RPCController@viewStudentDetails');
    Route::get('feedback', 'StudentController@viewStatus');
    Route::get('projectReRegistration', 'StudentProposalController@viewRegistrationForm');
    Route::post('projectReRegistration', 'StudentProposalController@Registration');
    Route::get('report', 'reportController@index');
    Route::get('studentprofile', 'reportController@viewStudentProfile');
    
    
    
    ////////////////////////diluni////////
    Route::get('diaryhome', 'diaryController@create');
    Route::get('tasks', 'diaryController@taskopen');
    Route::post('tasks', 'diaryController@storeTasks');
    
    /*if decommented research are delete wont work*/
//    Route::resource('DELETE', 'diaryController@destroy');
//    Route::get('DELETE/{id}', 'diaryController@destroy');
    
    ////////////////////////hiru////////
    Route::get('grouping', 'GroupController@viewPool');

    Route::post('report', 'reportController@add');
    Route::get('reportfile', 'reportController@viewIntReport');
    Route::post('reportfile', 'reportController@deleterpt');
    Route::get('viewprogress', 'reportController@viewProgress');
});
//Student routes
Route::get('/upLinksView', 'uploadController@displayLinks');
Route::get('/uploads/{linkId}', 'uploadController@uploadView');
Route::post('/uploads/{linkId}', 'submissionsController@saveUpload');
//Student routes

Route::post('login', 'AuthenticationController@postLogin');
Route::get('login', 'AuthenticationController@showLogin');
Route::get('/registration', 'StudentController@registration');
Route::post('register', 'StudentController@doRegistration');
Route::get('forgotpassword', 'AuthenticationController@getForgotPassword');
Route::post('forgotpassword', 'AuthenticationController@postForgotPassword');
Route::get('password-recover/{code}', array('as' => 'password-recover', 'uses' => 'AuthenticationController@getRecoverPassword'));
Route::post('resetpassword', 'AuthenticationController@postResetPassword');
//supervisor Registration for the Accepted external supervisor
Route::get('rejectsExternalSupervisor/{supervisorid}', 'SupervisorController@confirmSupervisorRegistration');

Route::get('testt', 'AuthenticationController@getTestFunction');
Route::get('ajax/testt', 'AuthenticationController@ajaxTestFunction');
Route::post('testt', 'AuthenticationController@postTestFunction');
Route::get('/doesNotHaveSupervisor/{studentId}/{notificationId}/{projectId}', 'SupervisorController@showDoseNotHaveSupervisor');
Route::get('ViewPendingProjects', 'RPCController@viewPendingProjects');
Route::get('/notificationForSupervisor/{projectID}/{notificationID}/{InternalSupervisorId}', 'SupervisorController@RegisteredNotification');

Route::get('viewThesis/{id2}', 'thesisEvaluationController@viewEvaluatedForm');
Route::get('ViewPrposal/{id2}', 'ProposalEvaluationController@viewProposalEvaluation');
Route::get('testt', 'AuthenticationController@testFunction');
Route::get('notificationForSupervisor/{projectID}/{notificationID}/{InternalSupervisorId}', 'SupervisorController@RegisteredNotification');

//add Event
Route::get('addEventToTimeline/{validity}/{type}/{saveType}', 'EventController@addEvent');
//deleted specific event
Route::get('deleteEventToTimeline', 'EventController@deleteEvent');
//update event
Route::get('updateEventToTimeline', 'EventController@updateEvent');
//get Specific Data  event Id
Route::get('getEventDataDetails', 'EventController@getEventDataForPanelMember');
//get current user today events
Route::get('getCurrentUserTimeLine', 'EventController@getCurrentUserTodayTimeLineEvents');
//just read notification
//
Route::get('justReadNotification/{notId}', 'notificationController@ReadNotification');

Route::get('/test111', function() {

    $events = ThesisPresentationPanel::join('projects', 'projects.id', '=', 'thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id', 'projects.title', 'thesis_presentation_panels.date', 'thesis_presentation_panels.venue', 'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end')
            ->get();
    return view('proposalpresentations.addPanelByCalander')->with('events', $events);
});







