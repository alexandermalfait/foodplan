<? /** @var $dish Dish */ ?>

<div id="dish-form" xmlns="http://www.w3.org/1999/html">
    <div class="form-row">
        <?= Form::label('name', "Name", [ "class" => "focus"]) ?>
        <?= Form::text('name', $dish->getName(), [ 'size' => 40, 'class' => 'dish-name' ]) ?>
    </div>

    <div class="form-row">
        <?= Form::label('work', "Amount of work") ?>
        <?= View::make('dishes/preparation_time', [ 'value' => $dish->getPreparationTime() ?: 1 ])->render() ?>
    </div>

    <div class="form-row">
        <?= Form::label('work', "Min. weeks between suggestions") ?>
        <?= Form::text('min_weeks_between_suggestion', $dish->getMinWeeksBetweenSuggestion() ?: 6, ['size' => 3]) ?>
    </div>

    <div class="form-row">
        <?= Form::label('url', "URL") ?>
        <?= Form::text('url', $dish->getUrl(), [ 'size' => 40, 'class' => 'url']) ?>
    </div>

    <div class="form-row">
        <?= Form::label('picture', "Picture(s)") ?>

        <input type="file" name="picture" accept="image/*" />
    </div>

    <? foreach($dish->getPictures() as $picture) { ?>
        <div class="dish-picture">
            <img src="<?= picture_resized_url("dishes/{$picture->getFilename()}", 200, 100) ?>" />

            <?= Form::checkbox("remove_picture[]", $picture->getId(), false, ['id' => "remove-picture-{$picture->getId()}" ]) ?>
            <?= Form::label("remove-picture-{$picture->getId()}", "Delete this picture") ?>
        </div>
    <? } ?>

    <div class="form-row">
        <?= Form::label('notes', "Notes") ?>
        <?= Form::textarea('notes', $dish->getNotes()) ?>
    </div>

    <?= Form::submit('Save', [ 'class' => 'button' ]) ?>
</div>

