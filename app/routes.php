<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
Route::group(['before'=>'session','namespace' => 'TT\Controllers'],function()
{
    Route::post('/teacher',array('as'=>'teacher.post','uses'=>'Teacher\SignUpController@store'));
    Route::post('/parent',array('as'=>'parent.post','uses'=>'Parent\SignUpController@store'));
    Route::post('/pwd/reset', array('as'=>'pwd.reset.post','uses'=>'PasswordResetController@postReset'));
});
**/
Route::group(['namespace'=>'TT','before'=>'logout'], function() {
    Route::get('/logout',array('as'=>'logout'));
});

Route::group(['namespace'=>'TT','before'=>'auth.parent'], function() {
    Route::get('/parent/home',array('as'=>'home.parent','uses'=>'Home\Parent\Action\HomeAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'auth.teacher'], function() {
    Route::get('/teacher/home',array('as'=>'home.teacher','uses'=>'Home\Teacher\Action\HomeAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'auth.admin'],function() {
    Route::get('/admin/home',array('as'=>'home.admin','uses'=>'Home\Admin\Action\HomeAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'login.parent'], function() {
    Route::get('/parent/login',array('as'=>'login.parent.get','uses'=>'Auth\Parent\Action\LoginGetAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'login.teacher'], function() {
    Route::get('/teacher/login',array('as'=>'login.teacher.get','uses'=>'Auth\Teacher\Action\LoginGetAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'login.admin'],function() {
    Route::get('/admin/login',array('as'=>'login.admin.get','uses'=>'Auth\Admin\Action\LoginGetAction@act'));
});


Route::group(['namespace' => 'TT'], function() {
    Route::get('/', array('as'=>'home','uses'=>'Home\Action\HomeAction@act'));
    Route::get('/unauthorized',array('as'=>'not.auth','uses'=>'Common\Action\NotAuthAction@act'));

    Route::post('/parent/login', array('as'=>'login.parent.post','uses'=>'Auth\Parent\Action\LoginPostAction@act'));
    Route::post('/teacher/login', array('as'=>'login.teacher.post','uses'=>'Auth\Teacher\Action\LoginPostAction@act'));
    Route::post('/admin/login', array('as'=>'login.admin.post','uses'=>'Auth\Admin\Action\LoginPostAction@act'));
    Route::post('/teacher',array('as'=>'teacher.post','uses'=>'Register\Teacher\Action\RegisterAction@act'));
    Route::post('/print-codes',array('as'=>'printcodes.teacher','uses'=>'Teacher\Codes\Action\PrintCodesAction@act'));
});


/**
Route::group(['namespace' => 'TT\Controllers'],function() 
{
    //Route::get('/privacy', array('as'=>'privacy','uses'=>'HomeController@getPrivacy'));
    //Route::get('/terms-of-service', array('as'=>'tos','uses'=>'HomeController@getTOS'));


    //Route::post('/invite',array('as'=>'invite','uses'=>'WelcomeController@postInvite'));   
});

Route::group(['before' => 'auth','after' => 'nocache', 'namespace' => 'TT\Controllers'], function()
{
    Route::post('/print-codes',array('as'=>'print.codes','uses'=>'Teacher\StudentController@printCodes'));
    Route::resource('activity','ActivityController');

    Route::get('/activity/{id}/complete',array('as'=>'activity.complete.get','uses'=>'ActivityController@getComplete'));
    Route::post('/activity/{id}/complete',array('as'=>'activity.complete.post','uses'=>'ActivityController@postComplete'));
    
    Route::get('pwd/change',array('as'=>'pwd.change.get','uses'=>'PasswordResetController@getChange'));
    Route::post('pwd/change',array('as'=>'pwd.change.post','uses'=>'PasswordResetController@postChange'));

});
**/
