<?php
require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

if (!isLoggedIn()) {
    die('Unauthorized.');
}

$title        = '';
$content      = '';
$published_at = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title        = $_POST['title'];
    $content      = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {
        $conn = getDB();
        $sql  = "INSERT INTO article (title, content, published_at)
                VALUES (?,?,?)";

        $sql_statement = mysqli_prepare($conn, $sql);

        if ($sql_statement === false) {
            echo mysqli_error($conn);
        } else {

            if ($published_at == '') {
                $published_at = null;
            }

            mysqli_stmt_bind_param($sql_statement, 'sss', $title, $content, $published_at);

            if (mysqli_stmt_execute($sql_statement)) {
                $id = mysqli_insert_id($conn);
                redirect("/article.php?id=$id");
            } else {
                echo mysqli_stmt_error($sql_statement);
            }
        }
    }
}

?>


<?php require 'includes/header.php';?>

<h2>New Article</h2>

<?php require 'includes/article-form.php';?>

<?php require 'includes/footer.php';?>