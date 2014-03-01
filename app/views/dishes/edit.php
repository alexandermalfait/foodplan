<? /** @var $dish Dish */ ?>

<form action="<?= action('DishesController@postUpdate', [ 'id' => $dish->getId() ]) ?>" method="post" enctype="multipart/form-data">
    <?= View::make('dishes/form', [ 'dish' => $dish ]) ?>
</form>
