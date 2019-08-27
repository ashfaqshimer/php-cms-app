<?php

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($conn, $_GET['id'], 'id');

    if ($article) {
        $id = $article['id'];

    } else {
        die('Article not found.');
    }
} else {
    die('id not supplied, article not found.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM article WHERE id = ?";

    $sql_statement = mysqli_prepare($conn, $sql);

    if ($sql_statement === false) {
        echo mysqli_error($conn);
    } else {

        mysqli_stmt_bind_param($sql_statement, 'i', $id);

        if (mysqli_stmt_execute($sql_statement)) {
            redirect("/index.php");
        } else {
            echo mysqli_stmt_error($sql_statement);
        }
    }
}

?>

<?php require 'includes/header.php'?>

<h2>Delete article</h2>

<form method='post'>
    <p>Are you sure?</p>
    <button type='submit'>Delete</button>
    <a href="index.php">Cancel</a>
</form>

<?php require 'includes/footer.php';?>