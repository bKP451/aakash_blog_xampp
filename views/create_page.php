<?php 
include('../server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>POST A POST ARTICLE AAKASH</title>
    <link rel="stylesheet" type="text/css" href="/./../high_explorer_com/decoration/create_page.css">
</head>
<body>
	
<?php	if(isset($_SESSION['admin-name'])){ ?>

    <h1>Upload a new ARTICLE !! </h1>
	<hr>
	<form method="post" action="/../high_explorer_com/server.php" enctype="multipart/form-data">
		<!-- When updating, the values should be filled with the previous articles !! -->

	<div class="input-group">
			<label>Post Title</label>
			<input type="text" name="post_title" value="<?php if($update == TRUE) { echo $article_heading;} else {'';}?>">
		</div>
		<div class="input-group">
			<label for="article-content">Post Content</label>
            <br>
			<textarea id="article-content"  name="post_body" rows="4" cols="50"><?php if($update == TRUE) { echo htmlspecialchars($article_body);} else {'';}?></textarea> 
		</div>

	<div class="input-group">
		<label for="article-image">Change article Image </label>
		<span class="img-div">
		  <div class="image-placeholder" onclick="triggerClick()">
		     <h4>Update Article Image</h4>
		</div>
		<?php if($update == TRUE) 
		{
			$image_path = $article_image_filename;
		} else {
			$image_path = 'Mausoleum_of_Omar_Khayyam.jpg';
			}
		?>
		 <img src="/./../high_explorer_com/post-images/<?php echo $image_path ?>" class="default-post-image" onclick="triggerClick()">
		</span>
		<input type="file" name="articleImage" onChange="displayImage(this)" id="articleImage" style="display:none;">
	</div>
		<!-- configure buttons for create new post and update that post -->
		<div class="input-group">
			<?php if ($update == TRUE) { ?>
				<!-- This is for holding the id of the article -->
				<input type = "hidden" name="post_id" value="<?php echo $id; ?>">
				<button class="btn" type="submit" name="update" >Update</button>
			<?php } else { ?>
				<button class="btn" type="submit" name="upload" >Save</button>
			<?php } ?>
		</div>

		<?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span>$error</span>";
                    }
                ?>  
				
	</form>
	<?php }  else { ?>
	<?php	
		echo "Good day !! YOU ARE THE READER<br>";
        echo "View Aakash blog at <a href='/../index.php'>high-explorer</a>";
		?>
    <?php } ?>
	<!-- <script type="text/javascript" src="/../javascripts-files/post-image-handling.js"> -->
		
		
		<script>
			function triggerClick(e) {
  						document.querySelector('#articleImage').click();
		}


	function displayImage(e) {
  	if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('.default-post-image').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
			</script>

<?php
    unset($_SESSION["error"]);
?>
</body>
</html>