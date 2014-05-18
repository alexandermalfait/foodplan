<?php

class PlanningController extends BaseController {

    function __construct() {
        parent::__construct();
        $this->beforeFilter('@checkLogin');
    }

    public function getIndex() {
        return self::getRedirectToWeek(new DateTime());
    }

    public function getWeek($monday) {
        $monday = new DateTime($monday);

        $dates = [];

        foreach(date_get_dates_in_week($monday) as $date) {
            /**
             * @var $planning DishPlanning
             */
            $planning = Doctrine::createQuery(
                "SELECT p FROM DishPlanning p WHERE p.user = :user AND p.date = :date"
            )
            ->setParameters(['user' => $this->getCurrentUser(), 'date' => $date])
            ->getOneOrNullResult();

            $row = ['date' => $date, 'planning' => $planning];

            $row['day_class'] = '';

            if (date_param($date) == date_param(new DateTime())) {
                $row['day_class'] = 'today';
            }
            else if(in_array($date->format('N'), [ 6, 7 ])) {
                $row['day_class'] = 'weekend';
            }

            if(Input::get('suggested_date') == date_param($date)) {
                $row['preparationTime'] = Input::get('suggested_preparation_time');
                $row['vegetarian'] = Input::get('suggested_vegetarian') == true;
            }
            else if($planning) {
                $row['preparationTime'] = $planning->getDish()->getPreparationTime();
                $row['vegetarian'] = $planning->getDish()->isVegetarian();
            }
            else {
                $row['preparationTime'] = null;
                $row['vegetarian'] = false;
            }

            $dates[] = $row;
        }

        return $this->renderInLayout(
            View::make("planning/week", [
                'dates' => $dates,
                'nextMonday' => date_add_days($monday, 7),
                'previousMonday' => date_add_days($monday, -7)
            ])
        );
    }


    public function getMakeSuggestion($date) {
        $maxPreparationTime = intval(Input::get('preparation_time', 0));
        $vegetarian = Input::get('vegetarian') == "true";

        $date = new DateTime($date);

        /**
         * @var $query \Doctrine\ORM\QueryBuilder
         */
        $query = Doctrine::createQueryBuilder()->select('d')->from("Dish", "d");

        $query = $query->andWhere("d.user = :user");
        $query->setParameter("user", $this->getCurrentUser());

        if ($maxPreparationTime > 0) {
            $query = $query->andWhere("d.preparationTime <= $maxPreparationTime");
        }

        if ($vegetarian) {
            $query = $query->andWhere("d.vegetarian = true");
        }

        $possibleDishes = $query->getQuery()->getResult();

        $possibleDishes = array_filter($possibleDishes, function(Dish $dish) use($date) {
            $lastPlanningDate = Doctrine::createQuery(
                "SELECT MAX(p.date) FROM DishPlanning p WHERE p.dish = :dish"
            )->setParameter("dish", $dish)->getSingleScalarResult();

            if ($lastPlanningDate) {
                $lastPlanningDate = new DateTime($lastPlanningDate);

                $date = clone($date);
                $interval = new DateInterval("P" . $dish->getMinWeeksBetweenSuggestion() . "W");

                return $lastPlanningDate->getTimestamp() < $date->sub($interval)->getTimestamp();
            }
            else {
                return true;
            }
        });

        $possibleDishes = array_values($possibleDishes);

        if($possibleDishes) {
            $dish = $possibleDishes[rand(0, sizeof($possibleDishes) - 1)];

            $this->planDish($date, $dish);
        }

        return self::getRedirectToWeek(
            $date,
            [ 'suggested_date' => date_param($date), 'suggested_preparation_time' => $maxPreparationTime, 'suggested_vegetarian' => $vegetarian ]
        );
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

        return self::getRedirectToWeek($date);
    }

    public function getClearDate($date) {
        $date = new DateTime($date);

        $this->deleteExistingPlanning($date);

        return self::getRedirectToWeek($date);
    }

    private function planDish(DateTime $date, Dish $dish) {
        $this->deleteExistingPlanning($date);

        $planning = new DishPlanning();

        $planning->setUser($this->getCurrentUser());
        $planning->setDate($date);
        $planning->setDish($dish);

        Doctrine::persist($planning);
    }

    public static function getRedirectToWeek(DateTime $date, $extraParams = array()) {
        return Redirect::to(
            action("PlanningController@getWeek", ['monday' => date_param(date_get_monday($date))]) . "?" . http_build_query($extraParams) . "#" .date_param($date)
        );
    }

}