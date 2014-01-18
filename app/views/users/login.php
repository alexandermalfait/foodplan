<h1>Login</h1>

<form method="post" action="<?= action('UsersController@executeLogin') ?>">
    Email:
    <?= Form::input("text", "email") ?>

    Password:
    <?= Form::input("text", "password") ?>

    <?= Form::submit("Login") ?>
</form>

<h1>Register</h1>

<form method="post" action="<?= action('UsersController@executeRegister') ?>">
    Email:
    <?= Form::input("text", "email") ?>

    Password:
    <?= Form::input("text", "password") ?>

    Repeat Password:
    <?= Form::input("text", "repeat_password") ?>

    <?= Form::submit("Login") ?>
</form>
