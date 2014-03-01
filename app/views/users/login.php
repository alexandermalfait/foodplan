<? if($message) { ?>
    <div class="message"><?= e($message) ?></div>
<? } ?>

<h1>Login</h1>

<form method="post" action="<?= action('UsersController@postExecuteLogin') ?>">
    <div class="form-row">
        <label>Email:</label>

        <?= Form::input("text", "email") ?>
    </div>

    <div class="form-row">
        <label>Password:</label>

        <?= Form::password("password") ?>
    </div>

    <?= Form::submit("Login", [ 'class' => 'button']) ?>
</form>

<h1>Register</h1>

<form method="post" action="<?= action('UsersController@postExecuteRegister') ?>">
    <div class="form-row">
        <label>Email:</label>

        <?= Form::input("text", "email") ?>
    </div>

    <div class="form-row">
        <label>Password:</label>

        <?= Form::password("password") ?>
    </div>

    <div class="form-row">
        <label>Repeat Password:</label>

        <?= Form::password("repeat_password") ?>
    </div>

    <?= Form::submit("Register", [ 'class' => 'button']) ?>
</form>
