<?php

class UsersController extends BaseController {

    public function getLogin($message = null) {
        return $this->renderInLayout(View::make('users/login', [ 'message' => $message ]));
    }

    public function postExecuteLogin() {
        $user = Doctrine::createQuery(
            "SELECT u FROM AppUser u WHERE LOWER(u.email) = :email AND u.password = :password"
        )
        ->setParameter("email", strtolower(Input::get('email')))
        ->setParameter("password", Input::get('password'))
        ->getOneOrNullResult();

        if ($user) {
            return $this->loginUser(Redirect::action("PlanningController@getIndex"), $user);
        }
        else {
            return Redirect::action('UsersController@getLogin', [ 'message' => 'Login failed' ]);
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