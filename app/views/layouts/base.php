<? /** @var $currentUser AppUser */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <?= $content ?>

    <hr />

    <? if($currentUser) { ?>
        <?= e($currentUser->getEmail()) ?>
        -
        <?= link_to_action('UsersController@getLogout', 'Log out') ?>
    <? } ?>
</body>
</html>
