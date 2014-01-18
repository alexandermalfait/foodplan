<? /** @var $dishes Dish[] */ ?>

<h1>
    Dishes

    <?= link_to_action("DishesController@getCreate", "Create new") ?>
</h1>

<div id="dishes-list">

    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <?= link_to_action("DishesController@getEdit", $dish->getName(), ['id' => $dish->getId()]) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
