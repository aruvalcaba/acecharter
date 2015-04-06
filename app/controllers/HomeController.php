<?php namespace TT\Controllers;

use View;
use BaseController;

class HomeController extends BaseController {

	public function showHome()
	{
		return View::make('pages.home');
    }

    public function getLogin()
    {
        return View::make('pages.login')->with('grades',[''=>'','K'=>'Kindergarten','First'=>'1']);
    }
}
