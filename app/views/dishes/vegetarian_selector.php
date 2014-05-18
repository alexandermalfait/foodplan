
<span class="vegetarian-selector">
    <?= Form::hidden('vegetarian', $state ? "true" : "false") ?>

    <img src="<?= asset('images/not_vegetarian.png') ?>" class="not-vegetarian" />

    <img src="<?= asset('images/vegetarian.png') ?>" class="vegetarian" />
</span>

