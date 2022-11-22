<?php
    session_start();
    session_unset();
    session_destroy();
    header("location:/./../high_explorer_com/index.php");
?>