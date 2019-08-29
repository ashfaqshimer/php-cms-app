<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    $article = Article::getByID($conn, $_GET['id']);

    if (!$article) {
        die('Article not found.');
    }
} else {
    die('id not supplied, article not found.');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $previous_image = $article->image_file;
    if ($article->setImage($conn, null)) {
        if ($previous_image) {
            unlink("../uploads/$previous_image");
        }
        Url::redirect("/admin/edit-article-image.php?id={$article->id}");
    }
}

?>

<?php require '../includes/header.php';?>

<h2>Delete Article Image</h2>

<?php if ($article->image_file): ?>
    <img src="/uploads/<?=$article->image_file;?>" alt="<?=$article->image_file;?>">
<?php endif;?>

<form method='post' enctype='multipart/form-data'>
    <p>Are you sure?</p>
    <button type='submit'>Delete</button>
    <a href="edit-article-image.php?id=<?=$article->id;?>">Cancel</a>
</form>


<?php require '../includes/footer.php';?>
