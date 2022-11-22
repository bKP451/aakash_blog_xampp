<?php

ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'localhost';

// Database use name
$user = 'root';

//database user password
$pass = '';

// check the MySQL connection status
$conn = new mysqli($host, $user, $pass,"khayyamp_BLOG");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// create table articles query
$create_table_articles = "CREATE TABLE IF NOT EXISTS `khayyamp_BLOG`.`ARTICLES` (`post_id` INT NOT NULL AUTO_INCREMENT , `post_title` VARCHAR(255) NOT NULL , 
`post_body` TEXT NOT NULL, 
`article_image_name` varchar(255) NOT NULL,
`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`post_id`)) ENGINE = InnoDB;";


// create table aakash_admin query
$create_table_aakash_admin = "CREATE TABLE IF NOT EXISTS `khayyamp_BLOG`.`aakash_admin` (`username` VARCHAR(100) NOT NULL ,
 `password` VARCHAR(100) NOT NULL ) ENGINE = InnoDB; ";

// create table articles execution

$create_table_articles_execution = $conn->query($create_table_articles);
$create_table_aakash_admin_execution = $conn->query($create_table_aakash_admin);

if($create_table_articles_execution != TRUE) {
    echo "could not create articles table !!!";
}

if($create_table_aakash_admin_execution != TRUE) {
    echo "could not create aakash_admin table !!";
}



?>
