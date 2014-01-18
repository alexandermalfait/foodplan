<?php

class UsersController extends BaseController {

    public function login() {
        return $this->renderInLayout(View::make('users/login'));
    }

    public function executeLogin() {

    }

    public function executeRegister() {
        $user = new AppUser();

        $user->setEmail(Input::get('email'));
        $user->setPassword(Input::get('password'));

        Doctrine::persist($user);
    }

    function getLayout() {
        return "layouts/base";
    }
}