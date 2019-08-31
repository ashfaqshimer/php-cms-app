<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="/css/styles.css">

    <title>CMS App | Blog Website</title>
</head>
<body>
<div class="container">
    <header class='text-center'>
        <h1 class='display-1'>WORDS CMS</h1>
    </header>
    <nav>
        <ul class='nav d-flex justify-content-between border'>
            <li class='nav-item'><a class='nav-link' href="/">Home</a></li>
            <?php if (Auth::isLoggedIn()): ?>
                <li class='nav-item'><a class='nav-link' href="/admin/">Admin</a></li>
                <li class='nav-item'><a class='nav-link' href="/logout.php">Log out</a></li>
            <?php else: ?>
                <li class='nav-item'><a class='nav-link' href="/login.php">Log in</a></li>
            <?php endif;?>
            <li class='nav-item'><a class='nav-link' href="/contact.php">Contact</a></li>
        </ul>
    </nav>
    <section>
