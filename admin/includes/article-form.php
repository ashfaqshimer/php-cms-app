<?php if (!empty($article->errors)): ?>
    <ul>
        <?php foreach ($article->errors as $error): ?>
            <li><?=$error?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>

<form method='post'>
    <div class="">
        <label for="title">Title</label>
        <input type="text" name='title' id='title' placeholder='Article Title' value=<?=htmlspecialchars($article->title);?>>
    </div>

    <div class="">
        <label for="conent">Content</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder='Article content' ><?=htmlspecialchars($article->content);?></textarea>
    </div>

    <div class="">
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name='published_at' id='published_at' value=<?=htmlspecialchars($article->published_at);?>>
    </div>

    <button type='submit'>Save</button>
</form>