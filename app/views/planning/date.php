<?
/** @var $date DateTime */
/** @var $dayBefore DateTime */
/** @var $dayAfter DateTime */
/** @var $planning DishPlanning */
?>

<h1><?= $date->format("l d M Y") ?></h1>

<?= link_to_action("PlanningController@getDate", "<<", [ 'date' => date_param($dayBefore)]) ?>

<?= link_to_action("PlanningController@getDate", ">>", [ 'date' => date_param($dayAfter)]) ?>

<br />

<? if($planning) { ?>
    <strong><?= $planning->getDish() ?></strong>

    <br />
<? } ?>

<a href="<?= action('PlanningController@getMakeSuggestion', [ 'date' => date_param($date) ]) ?>">
    Suggestion
</a>

<br />

<a href="<?= action('PlanningController@getPickDish', [ 'date' => date_param($date) ]) ?>">
    Pick myself
</a>