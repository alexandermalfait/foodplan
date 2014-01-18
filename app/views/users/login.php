<h1>Login</h1>

<form method="post" action="<?= action('UsersController@postExecuteLogin') ?>">
    Email:
    <?= Form::input("text", "email") ?>

    Password:
    <?= Form::password("password") ?>

    <?= Form::submit("Login") ?>
</form>

<h1>Register</h1>

<form method="post" action="<?= action('UsersController@postExecuteRegister') ?>">
    Email:
    <?= Form::input("text", "email") ?>

    Password:
    <?= Form::password("password") ?>

    Repeat Password:
    <?= Form::password("repeat_password") ?>

    <?= Form::submit("Login") ?>
</form>
