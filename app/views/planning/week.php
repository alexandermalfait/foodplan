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

        <div class="week-date">
            <div class="date">
                <span class="week-day">
                    <?= $date->format("l") ?>
                </span>

                <span class="full-date">
                    <?= $date->format("d M y") ?>
                </span>
            </div>

            <div class="planned-dish">
                <? if($planning) { ?>
                    <?= $planning->getDish() ?>
                <? } else { ?>
                    ???
                <? } ?>
            </div>

            <div class="actions">
                <form action="<?= action('PlanningController@getMakeSuggestion', [ 'date' => date_param($date) ]) ?>" class="make-suggestion">
                    <div class="preparation-time">
                        <input type="hidden" name="preparation_time" />

                        <div class="stars"></div>
                    </div>

                    <button class="button" type="submit">Suggestion</button>
                </form>

                <a href="<?= action('PlanningController@getPickDish', [ 'date' => date_param($date) ]) ?>"  class="button last">
                    Pick myself
                </a>
            </div>
        </div>
    <? } ?>

    <div class="actions">
        <a href="<?= action('PlanningController@getWeek', [ 'date' => date_param($nextMonday) ]) ?>"  class="button">
            &raquo; Next Week
        </a>

        <a href="<?= action('PlanningController@getWeek', [ 'date' => date_param($previousMonday) ]) ?>"  class="button right">
            &laquo; Previous Week
        </a>
    </div>
</div>
