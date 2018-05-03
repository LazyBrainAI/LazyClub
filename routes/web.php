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
//Login, Register... Fix it
Auth::routes();

//Home routes
Route::get('/home', 'HomeController@returnEventsAndProjects');
Route::put('/home', 'HomeController@attendEvent');
Route::delete('/home', 'HomeController@unattendEvent');

//Profile routes
Route::get('/profile/{id}', 'UserController@getProfileDetails')->middleware('auth');
Route::post('/profile/{id}', 'UserController@editProfile');
Route::delete('/profile/{id}', 'UserController@deleteExperienceandEducation');


//Events routes
Route::get('/events', 'EventsController@showDetails');
Route::post('/events', 'EventsController@saveNewEvent');
Route::put('/events', 'EventsController@attendEvent');
Route::delete('/events', 'EventsController@unattendEvent');





//Event routes
Route::get('/event/{name}', 'EventController@showDetails');
Route::post('/event/{name}', 'EventController@editEventOrSaveReview');


Route::put('/event/{name}', 'EventController@goingEvent');
Route::delete('/event/{name}','EventController@ungoingEvent');


//People routes
Route::get('/people','PeopleController@showDetails');


//Projects routes
Route::get('/projects','ProjectsController@showDetails');
Route::post('/projects','ProjectsController@saveNewProject');

//Project
Route::get('/project/{name}', 'ProjectController@showDetails');

//HR panel
Route::get('/hrpanel', 'HRController@returnView');
Route::post('/hrpanel', 'HRController@sendMail');



//Account
Route::get('/account','AccountController@showDetails');
Route::post('/account','AccountController@changePassword');

