<?php
session_start();
require_once 'db_config.php';

// initialize $update to false at the beginning
$update = FALSE;
// code snippet for updating the article
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $specified_article_exec = $conn->query("SELECT * FROM ARTICLES WHERE post_id=$id");

if($specified_article_exec == TRUE){
    $old_article = $specified_article_exec->fetch_array(MYSQLI_ASSOC);
    $article_heading = $old_article["post_title"];
    $article_body = $old_article["post_body"];
    $article_image_filename = $old_article["article_image_name"];
}


}



// code snippet for deleting of the article

if(isset($_GET['del'])){
    if(isset($_SESSION['admin-name'])){
        // now delete operation will be here 
        $post_id = $_GET['del'];
        $specified_article_exec = $conn->query("SELECT * FROM ARTICLES WHERE post_id=$post_id");
        $delete_query_execution_result = $conn->query("DELETE FROM ARTICLES WHERE post_id=$post_id");

        if($specified_article_exec == TRUE){
            $old_article = $specified_article_exec->fetch_array(MYSQLI_ASSOC);
            $article_image_filename = $old_article["article_image_name"];
        }
        // Let me delete the corresponding image from the filesystem too
        if($article_image_filename != 'Mausoleum_of_Omar_Khayyam.jpg'){
            $delete_old_image = unlink("/opt/lampp/htdocs/high_explorer_com/post-images/$article_image_filename");
        } 
        
        if ($delete_old_image and $delete_query_execution_result){
            header('location:index.php');
        } else {
            echo "Could not delete successfully !!";
        }
        
    } else {
        echo "You can view Aakash Dawadi's blog at"."<a href='index.php'>AAKASH BLOG </a>";
    }
}




function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
           imagejpeg($image, $destination, $quality);
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            imagepng($image, $destination, $quality);
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            imagegif($image, $destination, $quality);
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
           imagejpeg($image, $destination, $quality);
    } 
     
     
    // Return compressed image 
    return $destination; 
} 
 
 
// File upload path 
 
 
// If file upload form is submitted 

function image_manipulation(){
    global $uploadPath;
    $uploadPath = "post-images/";
    global $fileName;
    $status = $statusMsg = ''; 
    $status = 'error'; 
    if(!empty($_FILES["articleImage"]["name"])) { 
        // File info 
        $fileName = basename($_FILES["articleImage"]["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["articleImage"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $_SESSION["error"] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
        } 
    }else{ 
        $_SESSION["message"] = 'You can skip the image upload [will upload default image]'; 
    } 


}



if(isset($_POST['upload'])){
    $post_title = $_POST['post_title'];
    $post_body = $_POST['post_body'];   

    

     image_manipulation();
    // If there is no error, then execute the sql

    if(!isset($_SESSION["error"])){
        // Default image for the articles 
        if(empty($fileName)){
            $fileName = 'Mausoleum_of_Omar_Khayyam.jpg';
        }
        $create_article_query = "INSERT INTO ARTICLES (post_title, post_body,article_image_name) VALUES ('$post_title', '$post_body', '$fileName')";
        $h = $conn->query($create_article_query);
        
        if ($h) {
            header('location:index.php');
            // echo "successfully saved !!";
        } else {
            echo "unsuccessful insert operation !!";
        }
    }

    
    
}

if(isset($_POST['update'])){
    // echo "I am the update operation !!!";
    // I have to get the id of the post that is to be updated

    $post_title = $_POST['post_title'];
    $post_body = $_POST['post_body'];   
    $post_id = $_POST['post_id'];
    $image_file_name =$_POST['image_file_name'];
    // The below code snippet will check whether the previous and current filename 
    // are same. If they are different, then only control goes to image_manipulation
    if ($_FILES["articleImage"]["name"]) {
    image_manipulation();
    
    if($_FILES["articleImage"]["name"] == $image_file_name){
        $_SESSION["error"] = "You are uploading the same image !!";
    }
    // Let me check whether the files are same or not 
    if(!isset($_SESSION["error"])){
        // Default image for the articles 
        // Now I have to delete the previous image attached to the post
        
        // Mausoleum_of_Omar_Khayyam.jpg will be our default image, so 
        // It won't be deleted !!
        if($image_file_name != 'Mausoleum_of_Omar_Khayyam.jpg'){
            $delete_old_image = unlink("/opt/lampp/htdocs/high_explorer_com/post-images/$image_file_name");
        } else {
            // Though we are not deleting the image, we are making the variable TRUE
            // so that below condition will run
            $delete_old_image = TRUE;
        }
        
    
}
    if($delete_old_image) {
        // I have to make a functionality that will update the image, if the user selects
    // another file
    $update_query = "UPDATE ARTICLES set post_title = '$post_title', post_body = '$post_body', article_image_name= '$fileName' where post_id='$post_id'";

    $update_query_execution = $conn->query($update_query);

    if ($update_query_execution) {
    header('location:index.php');
    } else {
    echo "unsuccessful update query execution !!";
    }

    }

} else {
    $fileName = $image_file_name;
    $update_query = "UPDATE ARTICLES set post_title = '$post_title', post_body = '$post_body', article_image_name= '$fileName' where post_id='$post_id'";

    $update_query_execution = $conn->query($update_query);

    if ($update_query_execution) {
    header('location:index.php');
    } else {
    echo "unsuccessful update query execution !!";
    }
}
    // If there is no error, then execute the sql
    

}


?>