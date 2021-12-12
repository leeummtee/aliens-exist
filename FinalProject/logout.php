<?php
session_start();
unset($_SESSION['isLoggedIn']); //Unsetting variable
session_destroy(); //Destroying session
header('Location: login.php'); //Prompt user to log in again
?>
