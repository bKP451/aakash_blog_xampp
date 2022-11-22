<?php
require_once './../db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer Login</title>
    <link rel="stylesheet" type="text/css" href="./../decoration/login_page.css">
</head>
<body>

<form action="./../validation/admin_form_validation.php" method="post">
  <div class="imgcontainer">
    <img src="./../dawadi_ankit_image.jpg" alt="dawadi_ankit_image" class="avatar">
  </div>

  <div class="container">
    <?php if(isset($_GET['error'])){ ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="admin-username">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="admin-password">

    <button type="submit" name="admin-login">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
  </div>
</form>
</body>
</html>
