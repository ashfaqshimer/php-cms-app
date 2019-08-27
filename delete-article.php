<?php

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';
require 'classes/Article.php';
require 'classes/Database.php';

$db   = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getByID($conn, $_GET['id']);

    if (!$article) {
        die('Article not found.');
    }
} else {
    die('id not supplied, article not found.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($article->delete($conn)) {
        redirect("/index.php");
    }
}

?>

<?php require 'includes/header.php'?>

<h2>Delete article</h2>

<form method='post'>
    <p>Are you sure?</p>
    <button type='submit'>Delete</button>
    <a href="article.php?id=<?=$article->id;?>">Cancel</a>
</form>

<?php require 'includes/footer.php';?>