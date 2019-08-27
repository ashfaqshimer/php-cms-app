<?php
require 'includes/url.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'secret') {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        redirect('/');
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
