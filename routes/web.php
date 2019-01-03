<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin', 'AdminController@login');
Route::match(['get', 'post'], 'admin', 'AdminController@login');



Route::group(['middleware' => ['auth','checkrole']], function(){
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkPassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    //Countries routes (admin)
    Route::match(['get', 'post'], '/admin/add-country', 'CountryController@addCountry');
    Route::match(['get', 'post'], '/admin/edit-country/{id}', 'CountryController@editCountry');
    Route::match(['get', 'post'], '/admin/delete-country/{id}', 'CountryController@deleteCountry');
    Route::get('/admin/view-countries', 'CountryController@viewCountries');

    //Cities routes (admin)
    Route::match(['get', 'post'], '/admin/add-city', 'CityController@addCity');
    Route::match(['get', 'post'], '/admin/edit-city/{id}', 'CityController@editCity');
    Route::match(['get', 'post'], '/admin/delete-city/{id}', 'CityController@deleteCity');
    Route::get('/admin/view-cities', 'CityController@viewCities');

    //Categories routes (admin)
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');

    //Companies routes (admin)
    Route::match(['get', 'post'], '/admin/add-company', 'CompanyController@addCompany');
    Route::match(['get', 'post'], '/admin/edit-company/{id}', 'CompanyController@editCompany');
    Route::match(['get', 'post'], '/admin/delete-company/{id}', 'CompanyController@deleteCompany');
    Route::get('/admin/view-companies', 'CompanyController@viewCompanies');
    Route::get('/admin/delete-company-image/{id}', 'CompanyController@deleteCompanyImage');

    //Users routes (admin)
    Route::match(['get', 'post'], '/admin/add-user', 'UserController@addUser');
    Route::match(['get', 'post'], '/admin/edit-user/{id}', 'UserController@editUser');
    Route::match(['get', 'post'], '/admin/delete-user/{id}', 'UserController@deleteUser');
    Route::get('/admin/view-users', 'UserController@viewUsers');
    Route::get('/admin/delete-user-image/{id}', 'UserController@deleteUserImage');

    //Meetings routes (admin)
    Route::match(['get', 'post'], '/admin/add-meeting', 'AdminMeetingController@addMeeting');
    Route::match(['get', 'post'], '/admin/edit-meeting/{id}', 'AdminMeetingController@editMeeting');
    Route::match(['get', 'post'], '/admin/details-meeting/{id}', 'AdminMeetingController@detailsMeeting');
    Route::match(['get', 'post'], '/admin/delete-meeting/{id}', 'AdminMeetingController@deleteMeeting');
    Route::match(['get', 'post'], '/admin/pdf-meeting-detail/{id}','AdminMeetingController@pdfMeetingDetail');
    Route::match(['get', 'post'], '/admin/pdf-meeting/{id}','AdminMeetingController@pdfMeeting');
    Route::get('/admin/view-meetings', 'AdminMeetingController@viewMeetings');
    Route::match(['get', 'post'], '/admin/update-meeting/{id}','AdminMeetingController@updateMeeting');

    //Meetings details routes (admin)
    Route::match(['get', 'post'], '/admin/add-meeting-detail/{id}', 'AdminMeetingDetailController@addMeeting');
    Route::match(['get', 'post'], '/admin/edit-meeting-detail/{id}', 'AdminMeetingDetailController@editMeeting');
    Route::match(['get', 'post'], '/admin/detail-meeting-comments/{id}', 'AdminMeetingDetailController@detailsMeeting');
    Route::match(['get', 'post'], '/admin/delete-meeting-detail/{id}', 'AdminMeetingDetailController@deleteMeeting');
    Route::match(['get', 'post'], '/admin/view-meetings-detail/{id}', 'AdminMeetingDetailController@viewMeetings');

    //Comments routes (admin)
    Route::match(['get', 'post'], '/admin/view-comment', 'AdminCommentController@viewComments');
    Route::match(['get', 'post'], '/admin/view-reply', 'AdminCommentController@viewReplies');
    Route::match(['get', 'post'], '/admin/update-comment/{id}','AdminCommentController@updateComment');
    Route::match(['get', 'post'], '/admin/add-reply/{id}', 'AdminCommentController@addReply');
    Route::match(['get', 'post'], '/admin/edit-reply/{id}','AdminCommentController@editReply');
    Route::match(['get', 'post'], '/admin/delete-reply/{id}', 'AdminCommentController@deleteReply');
    Route::match(['get', 'post'], '/admin/delete-comment/{id}', 'AdminCommentController@deleteComment');

    //Documents routes (admin)
    Route::get('/admin/view-documents', 'AdminController@viewDocuments');

    //Types routes (admin)
    Route::match(['get', 'post'], '/admin/add-type', 'TypeController@addType');
    Route::match(['get', 'post'], '/admin/edit-type/{id}', 'TypeController@editType');
    Route::match(['get', 'post'], '/admin/delete-type/{id}', 'TypeController@deleteType');
    Route::get('/admin/view-types', 'TypeController@viewTypes');

    //Subtypes routes (admin)
    Route::match(['get', 'post'], '/admin/add-subtype', 'SubtypeController@addSubtype');
    Route::match(['get', 'post'], '/admin/edit-subtype/{id}', 'SubtypeController@editSubtype');
    Route::match(['get', 'post'], '/admin/delete-subtype/{id}', 'SubtypeController@deleteSubtype');
    Route::get('/admin/view-subtypes', 'SubtypeController@viewSubtypes');

    //Projects routes (admin)
    Route::match(['get', 'post'], '/admin/add-project', 'ProjectController@addProject');
    Route::match(['get', 'post'], '/admin/edit-project/{id}', 'ProjectController@editProject');
    Route::match(['get', 'post'], '/admin/delete-project/{id}', 'ProjectController@deleteProject');
    Route::match(['get', 'post'], '/admin/details-project/{id}', 'ProjectController@detailsProject');
    Route::match(['get', 'post'], '/admin/update-project/{id}','ProjectController@updateProject');
    Route::get('/admin/view-projects', 'ProjectController@viewProjects');

    //Project details routes (admin)
    Route::match(['get', 'post'], '/admin/add-project-detail/{id}', 'AdminProjectDetailController@addProject');
    Route::match(['get', 'post'], '/admin/edit-project-detail/{id}', 'AdminProjectDetailController@editProject');
    Route::match(['get', 'post'], '/admin/delete-project-detail/{id}', 'AdminProjectDetailController@deleteProject');
    Route::match(['get', 'post'], '/admin/view-projects-detail/{id}', 'AdminProjectDetailController@viewProject');
    Route::match(['get', 'post'], '/admin/detail-project-solutions/{id}', 'AdminProjectDetailController@detailsProject');
    Route::match(['get', 'post'], '/admin/update-project-detail/{id}','AdminProjectDetailController@updateProjectDetail');

    //Solution routes (admin)
    Route::match(['get', 'post'], '/admin/add-solution/{id}', 'AdminSolutionController@addSolution');
    Route::match(['get', 'post'], '/admin/edit-solution/{id}', 'AdminSolutionController@editSolution');
    Route::match(['get', 'post'], '/admin/delete-solution/{id}', 'AdminSolutionController@deleteSolution');
    Route::get('/admin/view-solutions', 'AdminSolutionController@viewSolutions');
    Route::match(['get', 'post'], '/admin/update-solution/{id}','AdminSolutionController@updateSolution');
    Route::get('/admin/delete-solution-file/{id}', 'AdminSolutionController@deleteSolutionFile');

});

//Route::group(['middleware' => ['checkrole']], function(){
    Route::get('/author/about', 'HomeController@about');
    Route::get('/author/contact', 'HomeController@contact');
    Route::get('/author/meetings', 'HomeController@meetings');
    Route::match(['get', 'post'],'/author/comments/{id}', 'HomeController@comments');
    Route::match(['get', 'post'],'/author/meetings_details/{id}', 'HomeController@meetings_details');
    Route::get('/author/projects', 'HomeController@projects');
    Route::match(['get', 'post'],'/author/projects_details/{id}', 'HomeController@projects_details');
    Route::match(['get', 'post'],'/author/solutions/{id}', 'HomeController@solutions');

    Route::match(['get', 'post'],'/author/update-solution/{id}', 'HomeController@updateSolution');
    Route::match(['get', 'post'], '/author/add-solution/{id}', 'HomeController@addSolution');
//});


Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');


Route::resource('admin/comments', 'PostCommentsController',['names'=>[


    'index'=>'admin.comments.index',
    'create'=>'admin.comments.create',
    'store'=>'admin.comments.store',
    'edit'=>'admin.comments.edit',
    'show'=>'admin.comments.show'


]]);


//Route::resource('comment', 'CommentController');



Route::get('/logout', 'AdminController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');