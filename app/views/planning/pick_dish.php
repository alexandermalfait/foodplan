<? /** @var $date DateTime */ ?>
<? /** @var $dishes Dish[] */ ?>

<?= View::make('planning/date', [ 'date' => $date ]) ?>

<div id="dishes-list">
    <input type="text" id="search" value="Search..." size="20" autocomplete="off" />

    <?= link_to_action(
        "DishesController@getCreate",
        "New dish",
        [ 'forDate' => date_param($date) ],
        [ 'class' => 'button create-new', 'style' => 'float: right;']
    ) ?>

    <div class="clearfix"></div>

    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <?= View::make('dishes/links', [ 'dish' => $dish ])->render() ?>

            <?= link_to_action(
                "PlanningController@getSavePickDish",
                $dish->getName(),
                ['date' => date_param($date), 'dishId' => $dish->getId()],
                ['class' => 'dish-name']
            ) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
