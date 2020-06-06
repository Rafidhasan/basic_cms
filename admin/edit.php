<?php
    session_start();

    include_once('../includes/connections.php');
    include_once('../includes/article.php');

    // Instance of article class
    $article = new Article;
    $articles = $article->fetch_all();


    if(isset($_SESSION['logged_in'])) {
        // display edit page
        if(isset($_GET['id'], $_GET['title'], $_GET['content'])) {
            $id = $_GET['id'];
            $title = $_GET['title'];
            $content = $_GET['content'];
            if(empty($title) or empty($content)) {
                $error = 'All fields Required';
            }   else {
                $query = $pdo-> prepare("UPDATE articles SET article_title =? , article_content=? , article_timestamp=? WHERE article_id=?");
                $query->bindValue(1, $title);
                $query->bindValue(2, $content);
                $query->bindValue(3,time());
                $query->bindValue(4,$id);

                $query->execute();

                header('Location: ../index.php');
            }
        }
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
                <h4>Select an Article to Edit</h4>
                <?php if(isset($error)) : ?>
                    <small style="color: #aa0000;"><?php echo $error; ?></small>
                <?php endif; ?>
                <form action="edit.php" method="get">
                    <select name="id">
                        <?php foreach($articles as $article): ?>
                        <option value="<?php echo $article->article_id; ?>">
                            <?php echo $article->article_title; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <input type="text" name="title" placeholder="Title">
                    <br><br>
                    <textarea name="content" placeholder="Content" cols="50" rows="15"></textarea>
                    <br><br>
                    <input type="submit" value="Edit Article">
                </form>
                <br><br>
            </div>
        </body>
        </html>

        <?php
    }   else {
        echo 'pay ni';
    }

?>