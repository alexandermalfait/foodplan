<? /** @var $dish Dish */ ?>

<form action="<?= action('DishesController@postSave') ?>" method="post">
    <?= View::make('dishes/form', [ 'dish' => new Dish() ]) ?>
</form>
