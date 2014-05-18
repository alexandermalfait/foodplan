<? /** @var $dishes Dish[] */ ?>

<div id="dishes-list">
    <?= link_to_action("DishesController@getCreate", "Create new dish", [], [ 'class' => 'button create-new']) ?>

    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <?= View::make('dishes/links', [ 'dish' => $dish ])->render() ?>

            <?= link_to_action("DishesController@getEdit", $dish->getName(), ['id' => $dish->getId()]) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
