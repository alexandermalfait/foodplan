<? /** @var $currentUser AppUser */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script type="text/javascript">
       var BASE_URL = <?= json_encode(url()) ?>;
    </script>

    <script type="text/javascript" src="<?= asset_with_ts('app.js') ?>"></script>

    <link href='<?= asset_with_ts('css/style.css') ?>' type="text/css" rel="stylesheet"/>

    <script src="<?= asset('raty-2.5.2/lib/jquery.raty.min.js') ?>" type="text/javascript"></script>
</head>
<body>
    <?= $content ?>

    <hr />

    <? if($currentUser) { ?>
        <?= e($currentUser->getEmail()) ?>
        -
        <?= link_to_action('DishesController@getIndex', 'Dishes') ?>
        -
        <?= link_to_action('UsersController@getLogout', 'Log out') ?>
    <? } ?>
</body>
</html>
