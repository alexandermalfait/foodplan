<? /** @var $dish Dish */ ?>

<form action="<?= action('DishesController@postUpdate', [ 'id' => $dish->getId() ]) ?>" method="post">
    <?= View::make('dishes/form', [ 'dish' => $dish ]) ?>
</form>
