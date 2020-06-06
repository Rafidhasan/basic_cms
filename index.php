<?php
    include_once('includes/connections.php');
    include_once('includes/article.php');

    // Instance of article class
    $article = new Article;
    $articles = $article->fetch_all();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic CMS</title>
    <link rel="stylesheet" href="assets/style.css"></link>
</head>
<body>
    <div class="container">
        <a href="index.php" id="logo">CMS</a>
        <ol>
            <?php foreach($articles as $article): ?>
            <li>
                <a href="article.php?id=<?php echo $article -> article_id ?>"><?php echo $article -> article_title; ?></a> -
                <small>posted <?php echo date('l jS', $article->article_timestamp); ?> Jan</small>
            </li>
            <?php endforeach; ?>
        </ol>
        <br>
        <small><a href="admin/index.php">admin</a></small>
    </div>
</body>
</html>