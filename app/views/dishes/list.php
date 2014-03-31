<? /** @var $dishes Dish[] */ ?>

<div id="dishes-list">
    <?= link_to_action("DishesController@getCreate", "Create new dish", [], [ 'class' => 'button create-new']) ?>

    <? foreach ($dishes as $dish) { ?>
        <div class="dish">
            <? if($dish->getUrl()) { ?>
                <a href="<?= format_url($dish->getUrl()) ?>" target="_blank">
                    <img src="<?= asset('images/link.png') ?>" class="dish-link" />
                </a>
            <? } ?>

            <? foreach($dish->getPictures() as $picture) { ?>
                <a href="<?= picture_url("dishes/{$picture->getFilename()}") ?>" target="_blank">
                    <img src="<?= picture_resized_url("dishes/{$picture->getFilename()}", 60, 40) ?>" class="dish-picture" />
                </a>
            <? } ?>

            <?= link_to_action("DishesController@getEdit", $dish->getName(), ['id' => $dish->getId()]) ?>

            (<?= $dish->getMinWeeksBetweenSuggestion() ?>w)

            <?= View::make('dishes/preparation_time_view', ['value' => $dish->getPreparationTime()]) ?>
        </div>
    <? } ?>
</div>
