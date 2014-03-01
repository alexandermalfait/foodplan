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
            <? if($planning) { ?>
                <? foreach($planning->getDish()->getPictures() as $picture) { ?>
                    <a href="<?= picture_url("dishes/{$picture->getFilename()}") ?>" target="_blank">
                        <img src="<?= picture_resized_url("dishes/{$picture->getFilename()}", 60, 45) ?>" class="dish-picture" />
                    </a>
                <? } ?>
            <? } ?>

            <?= View::make('planning/date', [ 'date' => $date ]) ?>

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

                <a href="<?= action('PlanningController@getPickDish', [ 'date' => date_param($date) ]) ?>"  class="button">
                    Pick
                </a>

                <? if($planning) { ?>
                    <button class="button last more-planning-actions-button">
                        ...
                    </button>
                <? } ?>
            </div>

            <? if($planning) { ?>
                <div class="more-planning-actions" style="display: none">
                    <form
                        method="post"
                        enctype="multipart/form-data"
                        action="<?= action('DishesController@postAddPicture', [ 'dishId' => $planning->getDish()->getId(), 'backToDate' => date_param($date) ] ) ?>"
                        class="add-picture-to-planned-dish"
                        >
                        <strong>Add a picture:</strong>

                        <input type="file" name="picture" accept="image/*" capture="camera" />
                    </form>
                </div>
            <? } ?>
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
