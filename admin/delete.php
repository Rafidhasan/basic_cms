<?php
    session_start();

    include_once('../includes/connections.php');
    include_once('../includes/article.php');

    // Instance of article class
    $article = new Article;

    if(isset($_SESSION['logged_in'])) {
        // display delete page
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            echo $id;

            $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
            $query->bindValue(1, $id);
            $query->execute();

            header('Location: delete.php');
        }
        $articles = $article->fetch_all();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Basic CMS</title>
            <link rel="stylesheet" href="../assets/style.css"></link>
        </head>
        <body>
            <div class="container">
                <a href="index.php" id="logo">CMS</a>
                <br>
                <h4>Select an Article to delete</h4>
                <form action="delete.php" method="get">
                    <select onchange="this.form.submit();" name="id">
                        <?php foreach($articles as $article): ?>
                            <?php echo $article->article_id; ?>
                        <option value="<?php echo $article->article_id; ?>">
                            <?php echo $article->article_title; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </body>
        </html>

        <?php
    }   else {
        header('Location: index.php');
    }

?>