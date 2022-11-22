<?php
session_start();
?>

<?php require_once './../db_config.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PAGE</title>
<script src="https://kit.fontawesome.com/f563fa9849.js" crossorigin="anonymous"></script>
</head>

<body>
    
<?php if(isset($_SESSION['admin-name'])){ ?>


        <h1>THE ADMIN PAGE</h1>
        <h3>create a new article !!!</h3>
        <a href='create_page.php'>NEW ARTICLE </a>
        <br>
        
        <a href='/./../high_explorer_com/logout-scripts/logout.php'>Logout</a>
        <!-- loading the articles -->


      <?php  $read_articles_query = 'SELECT * FROM ARTICLES'; 
        $read_articles_query_execution = $conn->query($read_articles_query); 
        $number_of_articles = $read_articles_query_execution->num_rows; 

        // echo $number_of_articles;
        if($number_of_articles>0){ 
            while($article = $read_articles_query_execution->fetch_object()){ ?>
                <h1><?php echo $article->post_title ?></h1>
                <p>45</p>

                <!-- anchor tag for updating the specified article !! -->
                
                <a href="create_page.php?edit=<?php echo $article->post_id; ?>">
                <i class='fa-solid fa-pen-nib'></i>
            </a>
                <!-- anchor tag for deleting the specified article !! -->
                <button onClick="delete_confirmation('<?php echo $article->post_title; ?>', '<?php echo $article->post_id; ?>')">
            <i class='fa-solid fa-trash'></i>
                <!-- </a> -->
            </button>
                <hr>
           <?php } ?>
      <?php  }else { ?>
            <h2>NO ARTICLES !! YOU HAVE NOT POSTED ANY ARTICLES !!</h2>
       <?php } ?>
   <?php }else { ?>
        <h2>SORRY !! IT SEEMS YOU ARE NOT THE ADMIN</h2><br>
        <p>View Aakash blog at <a href='/../index.php'>high-explorer</a></p>
  <?php  }  ?>
  <script>
    function delete_confirmation(article_title, article_id){
        if (confirm(`Do you want to delete an article titled "${article_title}" ?`)){
            console.log("You really want me to delete !!");
            console.log(article_id);
            location.replace(`/./../server.php?del=${article_id}`);
        } else {
            console.log("You ought to keep me !!");
        }
    }
    </script>
</body>
</html>