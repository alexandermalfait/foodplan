<? /** @var $dish Dish */ ?>

<form action="<?= action('DishesController@postUpdate', [ 'id' => $dish->getId() ]) ?>" method="post" enctype="multipart/form-data">
    <?= View::make('dishes/form', [ 'dish' => $dish ]) ?>

    <a href="<?= action('DishesController@getDelete', ['id' => $dish->getId() ]) ?>" class="button delete-dish" onclick="return confirm('Really delete?')">
        Delete dish
    </a>

    <div class="clearfix"></div>
</form>
