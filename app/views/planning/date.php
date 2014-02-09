<? /** @var $date DateTime */ ?>

<div class="date">
    <span class="week-day">
        <?= $date->format("l") ?>
    </span>

    <span class="full-date">
        <?= $date->format("d M y") ?>
    </span>
</div>