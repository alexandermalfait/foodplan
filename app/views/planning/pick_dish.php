<? /** @var $date DateTime */ ?>
<? /** @var $dishes Dish[] */ ?>

<h1><?= $date->format("l d/m/Y") ?></h1>

<div id="dishes-list">
    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <?= link_to_action("PlanningController@getSavePickDish", $dish->getName(), ['date' => date_param($date), 'dishId' => $dish->getId()]) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
