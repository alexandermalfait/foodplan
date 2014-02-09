<?php

class DishesController extends BaseController {

    function __construct() {
        parent::__construct();
        $this->beforeFilter('@checkLogin');
    }

    public function getIndex() {
        $dishes = Doctrine::createQuery(
            "SELECT d FROM Dish d WHERE d.user = :user ORDER BY d.name"
        )
        ->setParameter("user", $this->getCurrentUser())
        ->execute();

        return $this->renderInLayout(View::make('dishes/list')->with('dishes', $dishes));
    }

    public function getCreate($forDate = null) {
        if ($forDate) {
            $forDate = new DateTime($forDate);
        }

        return $this->renderInLayout(View::make('dishes/create', [ 'forDate' => $forDate ]));
    }

    public function getEdit($id) {
        $dish = Doctrine::find("Dish", $id);

        return $this->renderInLayout(View::make('dishes/edit')->with('dish', $dish));
    }

    public function postUpdate($id) {
        $dish = Doctrine::find("Dish", $id);

        $this->bindInput($dish);

        return Redirect::action("DishesController@getIndex");
    }

    public function postSave() {
        $dish = new Dish();

        $this->bindInput($dish);

        Doctrine::persist($dish);
        Doctrine::flush();

        if (Input::get("for_date")) {
            return Redirect::action(
                "PlanningController@getSavePickDish", [ 'date' => Input::get("for_date"), 'dishId' => $dish->getId() ]
            );
        }
        else {
            return Redirect::action("DishesController@getIndex");
        }
    }

    /**
     * @param $dish
     */
    private function bindInput(Dish $dish) {
        $dish->setUser($this->getCurrentUser());
        $dish->setName(Input::get('name'));
        $dish->setPreparationTime(Input::get('preparation_time'));
        $dish->setMinWeeksBetweenSuggestion(Input::get('min_weeks_between_suggestion'));
    }
} 