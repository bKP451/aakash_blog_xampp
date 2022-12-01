<?php 
// This page will add the comments to the comment section
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

$commentator_full_name = $commentator_email_address = $article_comment = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $article_comment = trim($_POST['article_comment']);
    $commentator_full_name = trim($_POST['commentator_full_name']);
    $commentator_email_address = $_POST['commentator_email_address'];
    echo "HURRAY !! Browser has validated the form !!";
}

?>