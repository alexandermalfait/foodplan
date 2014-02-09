<?php

class PlanningController extends BaseController {

    public function getIndex() {
        return $this->getRedirectToWeek(new DateTime());
    }

    public function getWeek($monday) {
        $monday = new DateTime($monday);

        $dates = [];

        foreach(date_get_dates_in_week($monday) as $date) {
            $planning = Doctrine::createQuery(
                "SELECT p FROM DishPlanning p WHERE p.user = :user AND p.date = :date"
            )
            ->setParameters(['user' => $this->getCurrentUser(), 'date' => $date])
            ->getOneOrNullResult();

            $dates[] = [ 'date' => $date, 'planning' => $planning ];
        }

        return $this->renderInLayout(View::make("planning/week", [ 'dates' => $dates ]));
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

        return $this->getRedirectToWeek($date);
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

        return $this->getRedirectToWeek($date);
    }

    private function planDish(DateTime $date, Dish $dish) {
        $this->deleteExistingPlanning($date);

        $planning = new DishPlanning();

        $planning->setUser($this->getCurrentUser());
        $planning->setDate($date);
        $planning->setDish($dish);

        Doctrine::persist($planning);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function getRedirectToWeek(DateTime $date) {
        return Redirect::to(action("PlanningController@getWeek", ['monday' => date_param(date_get_monday($date))]) . "#" .date_param($date));
    }

} 