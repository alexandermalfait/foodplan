<? /** @var $dish Dish */ ?>

<div class="form-row">
    <?= Form::label('name', "Name") ?>
    <?= Form::text('name', $dish->getName()) ?>
</div>

<div class="form-row">
    <?= Form::label('work', "Amount of work") ?>
    <?= View::make('dishes/preparation_time', [ 'value' => $dish->getPreparationTime() ]) ?>
</div>

<div class="form-row">
    <?= Form::label('work', "Min. weeks between suggestions") ?>
    <?= Form::text('min_weeks_between_suggestion', $dish->getMinWeeksBetweenSuggestion(), ['size' => 3]) ?>
</div>

<?= Form::submit('Save') ?>