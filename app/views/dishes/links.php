<? /** @var $dish Dish */ ?>

<? if($dish->isVegetarian()) { ?>
    <img src="<?= asset('images/vegetarian.png') ?>" class="vegetarian" />
<? } ?>

<? if($dish->getUrl()) { ?>
    <a href="<?= format_url($dish->getUrl()) ?>" target="_blank">
        <img src="<?= asset('images/link.png') ?>" class="dish-link" />
    </a>
<? } ?>

<? foreach($dish->getPictures() as $picture) { ?>
    <a href="<?= picture_url("dishes/{$picture->getFilename()}") ?>" target="_blank">
        <img src="<?= picture_resized_url("dishes/{$picture->getFilename()}", 60, 40) ?>" class="dish-picture" />
    </a>
<? } ?>