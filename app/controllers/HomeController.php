<?php

class HomeController extends BaseController {

	public function showWelcome()
	{
        if ($this->getCurrentUser()) {
            return Redirect::action("PlanningController@getIndex");
        }
        else {
            return Redirect::action("UsersController@getLogin");
        }
	}
}