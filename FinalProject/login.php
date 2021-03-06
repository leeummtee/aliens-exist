<?php
include_once("database.php"); //Connect to the database
session_start();
if(isset($_SESSION['isLoggedIn'])) //If user is already logged in take them to the home page
{
  header('Location: home.php');
  exit();
}
if(isset($_POST['login'])) //If user is not logged in and attempts to log in, find user
{
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $result = $conn -> query("SELECT username FROM member WHERE username = '$user' AND password = '$pass'");

    if($result -> num_rows > 0) //If a user exists
    {
      $_SESSION['isLoggedIn'] = 1;
      $_SESSION['username'] = $user;
      exit('success');
    } else {
      exit('fail');
    }
    exit($user . "=" . $pass);
}

if(isset($_POST['signup']))
{
  header("Location: signup.php");
}
?>
<html>
<head>
  <title>Login Page</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="css/main.css" rel="stylesheet">
</head>

<body id="login">
  <nav>
    <!-- logo in the top left -->
    <div class="topnav">
      <div class="topnav-left">
        <a href="home.php">
          <img class="logo-img-nav" src="imgs/logo.png" alt="ufo logo">
          <!-- <span> <img class="logo" src="imgs/logo.png" alt="ufo logo"> </span> -->
        </a>
      </div>
    </div>

    <!-- reference for sidenav from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav -->
    <!-- reference for making sidenav accessible with tab index https://knowbility.org/blog/2020/accessible-slide-menus/ -->
    <button class="icon-right-justified" onclick="openNav()">&#9776;</button>
    <div id="mySidenav" class="sidenav inactive">
      <a href="javascript:void(0)" role="button" class="closebtn" aria-label="close navigation" onclick="closeNav()">&times;</a>
      <a href="login.php">login</a>
			<a href="signup.php">sign up</a>
			<a href="home.php">home</a>
			<a href="posts.php">posts</a>
			<a href="add_posts.php">add posts</a>
			<a href="profile.php">profile</a>
			<a href="logout.php">logout</a>

  </nav>

 <section class="container-login">
    <div class="block-login">
      <form action = "login.php" method = "POST">
        <div class="container-login-logo">
          <img class="logo-img" src="imgs/logo.png" alt="ufo logo">
        </div>
        <h1> Log in. The truth awaits. </h1>
        <p>
          <input class="input-text" type = "text" id ="user" name  = "user" placeholder="Enter username"/>
        </p>
        <p>
          <input class="input-text" type = "password" id ="pass" name  = "pass" placeholder="Enter password"/>
        </p>

        <div class="container-login-buttons">
          <input class="button-form" type =  "button" value = "Login" id = "login"/>
          <input class="button-form" type="submit" value="Sign Up" name = "signup"/>
        </div>
    </div>
      </form>
  </section>

    <script type = "text/javascript">
    //Saving log in information
      $(document).ready(function (){
        $("#login").click(function(){
        var user = $("#user").val();
        var pass = $("#pass").val();
        $.ajax(
          {
            url:'login.php',
            method: 'POST',
            data: {
              login: 1,
              username: user,
              password: pass
            },
            success: function (response)
            {
              $("#response").html(response);
              if(response.indexOf('success') >= 0)
                window.location = 'posts.php';
            },
            dataType: 'text'
          }
        )
      });
    });
    </script>

  <footer class="section-divider-footer">
    <div class="container-footer">
      <p> ??2021 - Group2 | </p>
      <a class="link" href="login.php"> login </a>
      <a class="link" href="signup.php"> sign up </a>
      <a class="link" href="posts.php"> posts </a>
    </div>
  </footer>

  <!-- linking javascript file -->
  <script src="js/main.js"></script>
</body>
</html>
