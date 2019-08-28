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
    <h2>Login</h2>
        <?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?=$error?></li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
    <div>
        <label for="username">Username</label>
        <input id='username' name='username' type="text">
    </div>
    <div>
        <label for="password">Password</label>
        <input id='password' name='password' type="password">
    </div>
    <button type='submit'>Login</button>
</form>

<?php require 'includes/footer.php';?>
