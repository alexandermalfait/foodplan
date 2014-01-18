<?php

class UsersController extends BaseController {

    public function getLogin() {
        return $this->renderInLayout(View::make('users/login'));
    }

    public function postExecuteLogin() {
        $users = Doctrine::createQuery(
            "SELECT u FROM AppUser u WHERE u.email = :email AND u.password = :password"
        )
        ->setParameter("email", Input::get('email'))
        ->setParameter("password", Input::get('password'))
        ->getResult();

        if ($users) {
            return $this->loginUser(Redirect::home(), $users[0]);
        }
        else {
            return Redirect::action('UsersController@login', [ 'message' => 'Login failed' ]);
        }
    }

    public function postExecuteRegister() {
        $user = new AppUser();

        $user->setEmail(Input::get('email'));
        $user->setPassword(Input::get('password'));

        Doctrine::persist($user);

        return Redirect::home();
    }


    private function loginUser($response, AppUser $user) {
        $response->withCookie(Cookie::forever("user_id", $user->getId()));
        $response->withCookie(Cookie::forever("user_password", $user->getPassword()));

        return $response;
    }

    public function getLogout() {
        return $this->logoutUser(Redirect::home());
    }

    private function logoutUser($response) {
        $response->withCookie(Cookie::forget("user_id"));
        $response->withCookie(Cookie::forget("user_password"));

        return $response;
    }
}