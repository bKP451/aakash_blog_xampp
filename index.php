<?php require_once 'db_config.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link rel="stylesheet" type="text/css" href="/./decoration/index_page.css"> -->
    <title>PANDEY TWEAKS</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <ul class="nav_list">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    
    <!-- Have to dynamically render article card contents -->

    <?php
    $read_articles_query = "SELECT post_id, post_title, post_body, article_image_name, DATE_FORMAT(updated_at, '%M %e %Y') AS formatted_upated_at FROM ARTICLES";
    $read_articles_query_execution = $conn->query($read_articles_query);
    $number_of_articles = $read_articles_query_execution->num_rows;
    if($number_of_articles>0){
        while($article = $read_articles_query_execution->fetch_object()){  ?>

  <img src='/./high_explorer_com/post-images/<?php echo $article->article_image_name;?>'>
  <?php echo $article->article_image_name;?>
  <h1><?php echo $article->post_title; ?></h1>
  <div>
    <p class="para_text"><?php echo ((strlen($article->post_body)>100) ? (substr($article->post_body, 0,100)):($article->post_body)) ?>
    <a href="/./high_explorer_com/views/article_page.php?article_id=<?php echo $article->post_id; ?>">...Read more</a>
    </p>
  </div>
    </section>    
  <?php } ?>
  <?php } else { ?> 
    <?php    echo "NO ARTICLES !! BROTHER AND SISTERS !"; ?>
   <?php }  ?>
</body>
</html>

