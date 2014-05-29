<? /** @var $dishes Dish[] */ ?>

<div id="dishes-list">
    <input type="text" id="search" value="Search..." size="20" autocomplete="off" />

    <?= link_to_action(
        "DishesController@getCreate",
        "Create new dish",
        [],
        [ 'class' => 'button create-new', 'style' => 'float: right;']
    ) ?>

    <div class="clearfix"></div>

    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <?= View::make('dishes/links', [ 'dish' => $dish ])->render() ?>

            <?= link_to_action("DishesController@getEdit", $dish->getName(), ['id' => $dish->getId()], ['class' => 'dish-name']) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
