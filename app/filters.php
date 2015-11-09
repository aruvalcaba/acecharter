<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth.parent',function() {
    if( Sentry::check() ) {
        if( ! Sentry::getUser()->isParent() ) {
            return Redirect::route('not.auth');
        }

        return;
    }
});

Route::filter('auth.teacher',function() {
    if( Sentry::check() ) {
        if( ! Sentry::getUser()->isTeacher() ) {
            return Redirect::route('not.auth');
        }

        return;
    }
});

Route::filter('auth.admin',function() {
    if( Sentry::check() ) {
        if( ! Sentry::getUser()->isAdmin() ) {
            return Redirect::route('not.auth');
        }

        return;
    }

    return Redirect::route('login.admin.get');
});

Route::filter('login.parent',function() {
    if( Sentry::check() ) {
        if( Sentry::getUser()->isParent() ) {
            return Redirect::route('home.parent');
        }

        else {
            return Redirect::route('not.auth');
        }
    }
});

Route::filter('login.teacher',function() {
    if( Sentry::check() ) {
        if( Sentry::getUser()->isTeacher() ) {
            return Redirect::route('home.teacher');
        }

        else {
            return Redirect::route('not.auth');
        }
    }
});

Route::filter('login.admin',function() {
    if( Sentry::check() ) {
        if( Sentry::getUser()->isAdmin() ) {
            return Redirect::route('home.admin');
        }

        else {
            return Redirect::route('not.auth');
        }
    }
});

Route::filter('logout',function() {
    if( Sentry::check() ) {
        Sentry::logout();
    }

    return Redirect::route('home');
});

Route::filter('nocache',function($route, $request, $response) {
    // No caching for pages, you can do some checks before
        $response->header("Pragma", "no-cache");
        $response->header("Cache-Control", "no-store, no-cache, must-revalidate, max-age=0");
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
