<? /** @var $date DateTime */ ?>
<? /** @var $dishes Dish[] */ ?>

<?= View::make('planning/date', [ 'date' => $date ]) ?>

<div id="dishes-list">
    <?= link_to_action("DishesController@getCreate", "Create new dish", [ 'forDate' => date_param($date) ], [ 'class' => 'button create-new']) ?>

    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <?= link_to_action("PlanningController@getSavePickDish", $dish->getName(), ['date' => date_param($date), 'dishId' => $dish->getId()]) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
