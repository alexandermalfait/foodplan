<?
/**
 * @var $dates array
 * @var $previousMonday DateTime
 * @var $nextMonday DateTime
 */
?>

<div id="week-planning">
    <? foreach($dates as $row) { ?>
        <? $date = $row['date'] ?>

        <a name="<?= date_param($date) ?>"></a>

        <div class="week-date <?= $row['day_class'] ?>">
            <?= View::make('planning/week_date', $row)->render() ?>
        </div>
    <? } ?>

    <div class="actions week-navigation">
        <a href="<?= action('PlanningController@getWeek', [ 'date' => date_param($previousMonday) ]) ?>"  class="button">
            &laquo; Previous Week
        </a>

        <a href="<?= action('PlanningController@getWeek', [ 'date' => date_param($nextMonday) ]) ?>"  class="button right">
            &raquo; Next Week
        </a>
    </div>
</div>
