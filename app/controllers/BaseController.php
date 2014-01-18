<?php

abstract class BaseController extends Controller {

    function __construct() {
        $this->afterFilter(function() {
            Doctrine::flush();
        });
    }


    protected function renderInLayout(\Illuminate\View\View $view) {
        return View::make($this->getLayout(), array('content' => $view));
    }

    abstract function getLayout();

}