<?php
require 'includes/init.php';

$conn = require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (User::authenticate($conn, $username, $password)) {
        Auth::login();
        Url::redirect('/');
    }
    $errors[] = ('Invalid credentials');
}
?>

<?php require 'includes/header.php';?>

<form method='post'>
    <h2 class='display-4'>Login</h2>
        <?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?=$error?></li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
    <div class='form-group'>
        <label for="username">Username</label>
        <input class='form-control' id='username' name='username' type="text">
    </div>
    <div class='form-group'>
        <label for="password">Password</label>
        <input class='form-control' id='password' name='password' type="password">
    </div>
    <button class='btn btn-primary' type='submit'>Log in</button>
</form>

<?php require 'includes/footer.php';?>
