<?
/** @var $dates array */
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

            <? if($planning) { ?>
                <div class="planned-dish">
                    <?= $planning->getDish() ?>
                </div>
            <? } ?>

            <div class="actions">
                <a href="<?= action('PlanningController@getMakeSuggestion', [ 'date' => date_param($date) ]) ?>" class="button">
                    Suggestion
                </a>

                <a href="<?= action('PlanningController@getPickDish', [ 'date' => date_param($date) ]) ?>"  class="button">
                    Pick myself
                </a>
            </div>
        </div>
    <? } ?>

</div>
