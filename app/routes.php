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

Route::group(['namespace'=>'TT','before'=>'logout'], function() {
    Route::get('/logout',array('as'=>'logout'));
});

Route::group(['namespace'=>'TT','before'=>'auth.parent'], function() {
    Route::get('/parent/home',array('as'=>'home.parent','uses'=>'Home\Parent\Action\HomeAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'auth.teacher'], function() {
    Route::get('/teacher/home',array('as'=>'home.teacher','uses'=>'Home\Teacher\Action\HomeAction@act'));
});

Route::group(['namespace'=>'TT','before'=>'home'], function() {
    Route::get('/home',array('as'=>'home'));
});


Route::group(['namespace'=>'TT','before'=>'auth.admin'],function() {
    Route::get('/admin/home',array('as'=>'home.admin','uses'=>'Home\Admin\Action\HomeAction@act'));

    //Activites Resource
    Route::get('/activity/create',array('as'=>'activity.create','uses'=>'Activity\Crud\Create\Action\CreateAction@act'));
    Route::post('/activity',array('as'=>'activity.store','uses'=>'Activity\Crud\Store\Action\StoreAction@act'));
	Route::get('/activity/edit/{id}',array('as'=>'activity.edit','uses'=>'Activity\Crud\Edit\Action\EditAction@act'));
	Route::put('/activity/{id}',array('as'=>'activity.update','uses'=>'Activity\Crud\Update\Action\UpdateAction@act'));
    Route::delete('/activity/{id}',array('as'=>'activity.delete','uses'=>'Activity\Crud\Delete\Action\DeleteAction@act'));

    //Upload roster
    Route::get('/roster/upload',array('as'=>'roster.upload.show','uses'=>'Roster\Upload\Action\UploadAction@act'));
    Route::post('/roster/upload',array('as'=>'roster.upload.store','uses'=>'Roster\Store\Action\StoreAction@act'));
  
    //Goals roster
    Route::get('/goals/upload',array('as'=>'goals.upload.show','uses'=>'Goals\Upload\Action\UploadAction@act'));
    Route::post('/goals/upload',array('as'=>'goals.upload.store','uses'=>'Goals\Store\Action\StoreAction@act'));

	// Upload Academic Goals
    Route::get('/academic/upload',array('as'=>'academic.upload.show','uses'=>'Academic\Upload\Action\UploadAction@act'));
    Route::post('/academic/upload',array('as'=>'academic.upload.store','uses'=>'Academic\Store\Action\StoreAction@act'));


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
Route::group(['namespace'=>'TT','before'=>'login.parent'],function() {
    Route::get('/',array('as'=>'login.parent.get','uses'=>'Auth\Parent\Action\LoginGetAction@act'));
});

Route::group(['namespace' => 'TT'], function() {
    Route::get('/unauthorized',array('as'=>'not.auth','uses'=>'Common\Action\NotAuthAction@act'));
    Route::get('/{lang}',array('as'=>'lang','uses'=>'Lang\Action\LangAction@act'));
	Route::get('/pwd/change',array('as'=>'pwd.get','uses'=>'PWD\Action\PwdGetAction@act'));
	Route::get('/parent/goal/{id}',array('as'=>'goal.parent.get','uses'=>'Goals\Action\GoalsAction@act'));
    Route::get('/print/codes',array('as'=>'printcodes.teacher','uses'=>'Teacher\Codes\Action\PrintCodesAction@act'));

	Route::post('/pwd/change', array('as'=>'pwd.post','uses'=>'PWD\Action\PwdPostAction@act'));

	Route::post('/pwd/reset', array('as'=>'pwd.reset.post','uses'=>'PWD\RESET_PWD\Action\PwdResetAction@act'));

    Route::post('/parent/login', array('as'=>'login.parent.post','uses'=>'Auth\Parent\Action\LoginPostAction@act'));
	Route::post('/parent',array('as'=>'parent.post','uses'=>'Register\Parent\Action\RegisterAction@act'));
	Route::post('/addchild',array('as'=>'addchild.post','uses'=>'AddChild\Action\AddChildAction@act'));	
    Route::post('/teacher/login', array('as'=>'login.teacher.post','uses'=>'Auth\Teacher\Action\LoginPostAction@act'));
    Route::post('/admin/login', array('as'=>'login.admin.post','uses'=>'Auth\Admin\Action\LoginPostAction@act'));
    Route::post('/teacher',array('as'=>'teacher.post','uses'=>'Register\Teacher\Action\RegisterAction@act'));
});

