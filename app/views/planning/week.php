<?
/**
 * @var $dates array
 * @var $previousMonday DateTime
 * @var $nextMonday DateTime
 */
?>

<div id="week-planning">
    <? foreach($dates as $row) { ?>
        <?
        /**
         * @var $date DateTime
         * @var $planning DishPlanning
         */
        $date = $row['date'];
        $planning = $row['planning'];
        ?>

        <a name="<?= date_param($date) ?>"></a>

        <div class="week-date <?= $row['day_class'] ?>">
            <div class="date">
                <span class="week-day">
                    <?= $date->format("l") ?>
                </span>

                <span class="full-date">
                    <?= $date->format("d M y") ?>
                </span>
            </div>

            <? if($planning) { ?>
                <div class="planned-dish">
                    <?= $planning->getDish() ?>
                </div>
            <? } else { ?>
                <div class="no-planned-dish">???</div>
            <? } ?>

            <div class="actions">
                <form action="<?= action('PlanningController@getMakeSuggestion', [ 'date' => date_param($date) ]) ?>" class="make-suggestion">
                    <div class="preparation-time">
                        <input type="hidden" name="preparation_time" />

                        <div class="stars"></div>
                    </div>

                    <button class="button" type="submit">Suggestion</button>
                </form>

                <a href="<?= action('PlanningController@getPickDish', [ 'date' => date_param($date) ]) ?>"  class="button last">
                    Pick
                </a>
            </div>
        </div>
    <? } ?>

    <div class="actions week-navigation">
        <a href="<?= action('PlanningController@getWeek', [ 'date' => date_param($previousMonday) ]) ?>"  class="button">
            &laquo; Previous Week
        </a>

        <a href="<?= action('PlanningController@getWeek', [ 'date' => date_param($nextMonday) ]) ?>"  class="button right">
            &raquo; Next Week
        </a>
    </div>
</div>
