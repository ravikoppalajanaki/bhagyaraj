<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
   return redirect()->route('examlogin');
});
Route::get('/home', function () {
   return redirect()->route('dashboard');
});

// Authentication routes...
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
//Page Routes

Route::get('/denied', array('as' => 'denied', 'uses' => 'dashboard@denied'));
Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'dashboard@index'));

//Student
Route::get('/student', array('as' => 'student', 'uses' => 'dashboard@student'));
Route::post('/student/update', array('as' => 'studentupdate', 'uses' => 'dashboard@studentupdate'));
Route::post('/student/add', array('as' => 'studentadd', 'uses' => 'dashboard@studentadd'));
Route::get('/student/remove/{id}', array('as' => 'studentremove', 'uses' => 'dashboard@studentremove'));


//Teacher
Route::get('/teacher', array('as' => 'teacher', 'uses' => 'dashboard@teacher'));
Route::post('/teacher/update', array('as' => 'teacherupdate', 'uses' => 'dashboard@teacherupdate'));
Route::post('/teacher/add', array('as' => 'teacheradd', 'uses' => 'dashboard@teacheradd'));
Route::get('/teacher/remove/{id}', array('as' => 'teacherremove', 'uses' => 'dashboard@teacherremove'));

//Teacher
Route::get('/permission', array('as' => 'permission', 'uses' => 'dashboard@permission'));

//Supervisor
Route::get('/supervisor', array('as' => 'supervisor', 'uses' => 'dashboard@supervisor'));
Route::post('/supervisor/update', array('as' => 'supervisorupdate', 'uses' => 'dashboard@supervisorupdate'));
Route::post('/supervisor/add', array('as' => 'supervisoradd', 'uses' => 'dashboard@supervisoradd'));
Route::post('/supervisor/remove', array('as' => 'supervisorremove', 'uses' => 'dashboard@supervisorremove'));


Route::get('/questionbank', array('as' => 'questionbank', 'uses' => 'dashboard@questionbank'));
Route::post('/questionbank/update', array('as' => 'questionbankupdate', 'uses' => 'dashboard@questionbankupdate'));
Route::post('/questionbank/add', array('as' => 'questionbankadd', 'uses' => 'dashboard@questionbankadd'));
Route::post('/questionbank/remove', array('as' => 'questionbankremove', 'uses' => 'dashboard@questionbankremove'));


Route::get('/subject', array('as' => 'subject', 'uses' => 'dashboard@subject'));
Route::post('/subject/update', array('as' => 'subjectupdate', 'uses' => 'dashboard@subjectupdate'));
Route::post('/subject/add', array('as' => 'subjectadd', 'uses' => 'dashboard@subjectadd'));
Route::post('/subject/remove', array('as' => 'subjectremove', 'uses' => 'dashboard@subjectremove'));

//View Required Donation
Route::get('/myprofile', array('as' => 'myprofile', 'uses' => 'dashboard@myprofile'));
Route::post('/myprofile', array('as' => 'updatemyprofile', 'uses' => 'dashboard@updatemyprofile'));

Route::get('/settings', array('as' => 'settings', 'uses' => 'dashboard@settings'));
Route::post('/settings', array('as' => 'settingsupdate', 'uses' => 'dashboard@settingsupdate'));

//Admin User Route
Route::get('/admins', array('as' => 'admins', 'uses' => 'Admins@index'));
Route::get('/admins/view/{id}', array('as' => 'adminview', 'uses' => 'Admins@adminview'));
Route::post('/admins/delete', array('as' => 'admindelete', 'uses' => 'Admins@admindelete'));
Route::post('/admins/view/update', array('as' => 'adminupdate', 'uses' => 'Admins@adminupdate'));
Route::get('/admins/add', array('as' => 'adminadd', 'uses' => 'Admins@adminadd'));
Route::post('/admins/add', array('as' => 'adminaddpost', 'uses' => 'Admins@adminaddpost'));

//Admin Exams View Route
Route::get('/exams', array('as' => 'exams', 'uses' => 'dashboard@exams'));
Route::get('/exams/view/{id}', array('as' => 'examsview', 'uses' => 'dashboard@examsview'));
Route::get('/exams/delete/{id}', array('as' => 'examsremove', 'uses' => 'dashboard@examsremove'));
Route::get('report/generate', array('as' => 'reportgenerate', 'uses' => 'dashboard@reportgenerate'));

//website

Route::get('/exam/login', array('as' => 'examlogin', 'uses' => 'ExamController@login'));
//Route::get('/test/login', array('as' => 'testlogin', 'uses' => 'TestController@login'));
Route::post('/exam/login', array('as' => 'examloginpost', 'uses' => 'ExamController@loginpost'));
Route::get('/exam/start', array('as' => 'examStart', 'uses' => 'ExamController@examStart'));
Route::post('/exam/finished', array('as' => 'examFinished', 'uses' => 'ExamController@examFinished'));
