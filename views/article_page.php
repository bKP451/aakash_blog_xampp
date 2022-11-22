
<?php
require_once './../db_config.php';

if(isset($_GET['article_id'])){
    $article_id = $_GET['article_id']; 

    $specified_article_exec = $conn->query("SELECT * FROM ARTICLES where post_id=$article_id");

    if($specified_article_exec) { 
        $current_article = $specified_article_exec->fetch_array(MYSQLI_ASSOC);
        ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $current_article["post_title"]; ?></title>
    </head>
    <body>
        <h1><?php echo $current_article["post_title"]; ?></h1>
        <hr>
        <p>
            <?php echo $current_article["post_body"]; ?>
        </p>
    </body>
    </html>
   <?php } else { ?>
    <h1>Could not load article from the database !!</h1>
    <?php } ?>

<?php } else { ?>
    <!-- The statements when the page cannot dispaly the article by id -->
    <h2>Error</h2>
    <?php } ?>
    




