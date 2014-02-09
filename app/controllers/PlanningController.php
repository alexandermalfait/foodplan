<?php

class PlanningController extends BaseController {

    public function getIndex() {
        return Redirect::action("PlanningController@getDate", [ 'date' => date('Y-m-d') ]);
    }

    public function getDate($date) {
        $date = new DateTime($date);

        $planning = Doctrine::createQuery(
            "SELECT p FROM DishPlanning p WHERE p.user = :user AND p.date = :date"
        )
        ->setParameters([ 'user' => $this->getCurrentUser(), 'date' => $date ])
        ->getOneOrNullResult();

        return $this->renderInLayout(View::make("planning/date", [
            'date' => $date,
            'planning' => $planning,
            'dayAfter' => date_add_days($date, 1),
            'dayBefore' => date_add_days($date, -1)
        ]));
    }

    public function getMakeSuggestion($date) {
        $date = new DateTime($date);

        $possibleDishes = Doctrine::createQuery(
            "SELECT d FROM Dish d WHERE d.user = :user"
        )
        ->setParameters(['user' => $this->getCurrentUser() ])
        ->getResult();

        if($possibleDishes) {
            $dish = $possibleDishes[rand(0, sizeof($possibleDishes) - 1)];

            $this->planDish($date, $dish);
        }

        return Redirect::action("PlanningController@getDate", [ 'date' => date_param($date) ]);
    }

    /**
     * @param $date
     */
    private function deleteExistingPlanning($date) {
        Doctrine::createQuery(
            "DELETE FROM DishPlanning p WHERE p.user = :user AND p.date = :date"
        )
        ->setParameters(['user' => $this->getCurrentUser(), 'date' => $date])
        ->execute();
    }

    public function getPickDish($date) {
        $date = new DateTime($date);

        $dishes = Doctrine::createQuery(
            "SELECT d FROM Dish d WHERE d.user = :user ORDER BY d.name"
        )
        ->setParameter("user", $this->getCurrentUser())
        ->execute();

        return $this->renderInLayout(
            View::make('planning/pick_dish', [ 'date' => $date, 'dishes' => $dishes ])
        );
    }

    public function getSavePickDish($date, $dishId) {
        $date = new DateTime($date);

        $this->planDish($date, Doctrine::find('Dish', $dishId));

        return Redirect::action("PlanningController@getDate", [ 'date' => date_param($date) ]);
    }

    private function planDish(DateTime $date, Dish $dish) {
        $this->deleteExistingPlanning($date);

        $planning = new DishPlanning();

        $planning->setUser($this->getCurrentUser());
        $planning->setDate($date);
        $planning->setDish($dish);

        Doctrine::persist($planning);
    }

} 