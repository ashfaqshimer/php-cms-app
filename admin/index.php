<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 3, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>

<?php require '../includes/header.php';?>

    <h2>Administration</h2>

    <p><a href="new-article.php">New Article</a></p>

    <?php if (empty($articles)): ?>
        <p>No articles found.</p>
    <?php else: ?>

    <table class='table'>
        <thead>
            <th scope='col'>Title</th>
            <th scope='col'>Published</th>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                    <a href="/admin/article.php?id=<?=$article['id']?>"><?=htmlspecialchars($article['title']);?></a>
                </td>
                <td>
                    <?php if ($article['published_at']): ?>
                        <time><?=$article['published_at']?></time>
                    <?php else: ?>
                        <p>Unpublished <button class='publishBtn btn btn-info' data-id="<?=$article['id']?>">Publish</button></p>

                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <?php require '../includes/pagination.php';?>

    <?php endif;?>


<?php require '../includes/footer.php';?>
