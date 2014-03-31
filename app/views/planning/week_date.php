<?
/**
 * @var $date DateTime
 * @var $planning DishPlanning
 * @var $preparationTime int
 */

if ($planning) {
    $dish = $planning->getDish();
}
else {
    $dish = null;
}

?>

<? if($planning) { ?>
    <? if($dish->getUrl()) { ?>
        <a href="<?= format_url($dish->getUrl()) ?>" target="_blank">
            <img src="<?= asset('images/link.png') ?>" class="dish-link" />
        </a>
    <? } ?>

    <? if($dish->getNotes()) { ?>
        <img src="<?= asset('images/notes.png') ?>" class="toggle-notes" />
    <? } ?>

    <? foreach($dish->getPictures() as $picture) { ?>
        <a href="<?= picture_url("dishes/{$picture->getFilename()}") ?>" target="_blank">
            <img src="<?= picture_resized_url("dishes/{$picture->getFilename()}", 45, 45) ?>" class="dish-picture" />
        </a>
    <? } ?>

<? } ?>

<?= View::make('planning/date', [ 'date' => $date ])->render() ?>

<? if($planning) { ?>
    <div class="planned-dish">
        <?= $dish ?>
    </div>
<? } else { ?>
    <div class="no-planned-dish">???</div>
<? } ?>

    <div class="actions">
        <form action="<?= action('PlanningController@getMakeSuggestion', [ 'date' => date_param($date) ]) ?>" class="make-suggestion">
            <div class="preparation-time">
                <input type="hidden" name="preparation_time" value="<?= $preparationTime ?>" />

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
            action="<?= action('DishesController@postAddPicture', [ 'dishId' => $dish->getId(), 'backToDate' => date_param($date) ] ) ?>"
            class="add-picture-to-planned-dish"
            >
            <strong>Add a picture:</strong>

            <input type="file" name="picture" accept="image/*"  />
        </form>

        <div class="actions">
            <a href="<?= action('DishesController@getEdit', ['id' => $dish->getId() ]) ?>" class="button">
                Edit dish
            </a>

            <a href="<?= action('PlanningController@getClearDate', ['date' => date_param($date) ]) ?>" class="button">
                Clear this day
            </a>
        </div>
    </div>
<? } ?>

<? if($dish && $dish->getNotes()) { ?>
    <div class="dish-notes" style="display: none">
        <?= nl2br($dish->getNotes()) ?>
    </div>
<? } ?>