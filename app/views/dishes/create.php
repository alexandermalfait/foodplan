<?
/**
 * @var $dish Dish
 * @var $forDate DateTime
 */
?>

<form action="<?= action('DishesController@postSave') ?>" method="post" enctype="multipart/form-data">
    <? if($forDate) { ?>
        <?= Form::hidden("for_date", date_param($forDate)) ?>
    <? } ?>

    <?= View::make('dishes/form', [ 'dish' => new Dish() ]) ?>
</form>
