<?php 
session_start();

require_once './../db_config.php';

if(isset($_POST['admin-username']) && isset($_POST['admin-password'])){
   
    function validate($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
}

$uname = validate($_POST['admin-username']);
$pass = $_POST['admin-password'];
if(empty($uname)){
    header("Location:/../high_explorer_com/views/login_page.php?error=Username is required");
    exit();
} elseif(empty($pass)){
    header("Location:/../high_explorer_com/views/login_page.php?error=Password is required");
    exit();
}else {
    $sql = "SELECT * FROM aakash_admin WHERE username='$uname'";
    $result_of_admin_fetch = $conn->query($sql);
    // Associative array
    $admin_row = $result_of_admin_fetch->fetch_assoc();


    if (($result_of_admin_fetch->num_rows === 1 ) && (password_verify($pass, $admin_row["password"]))){
        // echo "Logged in !!";
        $_SESSION['admin-name'] = $admin_row['username'];
        header("Location:/./../high_explorer_com/views/admin_page.php");
        echo "Logged in !!!";
        exit();
    } else {
        header("Location:/../high_explorer_com/views/login_page.php?error=Invalid username or password");
        exit();
    }
}


 ?>
