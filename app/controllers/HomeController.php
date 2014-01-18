<?php

class HomeController extends BaseController {

	public function showWelcome()
	{
		return Redirect::action("UsersController@getLogin");
	}
}