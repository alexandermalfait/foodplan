<?
/** @var $dates array */
?>

<? foreach($dates as $row) { ?>
    <?
    /**
     * @var $date DateTime
     * @var $planning DishPlanning
     */
    $date = $row['date'];
    $planning = $row['planning'];
    ?>

    <a name="<?= date_param($date) ?>"></a>

    <h1><?= $date->format("l d M Y") ?></h1>

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
<? } ?>
