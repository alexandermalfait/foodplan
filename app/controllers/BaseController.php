<?php

abstract class BaseController extends Controller {

    function __construct() {
        $this->beforeFilter('@shareViewData');

        $this->afterFilter(function() {
            Doctrine::flush();
        });
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    public function shareViewData($route, $request) {
        View::share('currentUser', $this->getCurrentUser());
    }

    public function checkLogin($route, $request) {
        if ($this->getCurrentUser() == null) {
            return Redirect::action("UsersController@getLogin");
        }
        else {
            return null;
        }
    }

    protected function renderInLayout(\Illuminate\View\View $view) {
        return View::make($this->getLayout(), array('content' => $view->render()));
    }

    protected function getLayout() {
        return "layouts/base";
    }

    /**
     * @return AppUser|null
     */
    protected function getCurrentUser() {
        if (Cookie::get('user_id') && Cookie::get('user_password')) {
            return Doctrine::createQuery(
                "SELECT u FROM AppUser u WHERE u.id = :id AND u.password = :password"
            )
            ->setParameter("id", Cookie::get('user_id'))
            ->setParameter("password", Cookie::get('user_password'))
            ->getOneOrNullResult();
        }
        else {
            return null;
        }
    }
}