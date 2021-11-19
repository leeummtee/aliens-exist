<?php
include_once("database.php");
session_start();
if(isset($_SESSION['isLoggedIn']))
{
  header('Location: test.php');
  exit();
}
if(isset($_POST['login']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $result = $conn -> query("SELECT username FROM login WHERE username = '$user' AND password = '$pass'");

    if($result -> num_rows > 0)
    {
      $_SESSION['isLoggedIn'] = 1;
      $_SESSION['username'] = $user;
      exit('success');
    } else {
      exit('fail');
    }
    exit($user . "=" . $pass);
}
?>
<html>
<head>
<<<<<<< HEAD
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

<h1>Login</h1>
  <form action = "login.php" method = "POST">
      <p>
        <label> Username: </label> <input type = "text" id ="user" name  = "user" placeholder="enter username"/>
      </p>
      <p>
        <label> Password: </label>
        <input type = "password" id ="pass" name  = "pass" placeholder="enter password"/>
      </p>
      <!--<label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label> <br> <br> -->
      <input type =  "button" value = "login" id = "login"/>
    </form>
=======
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="css/styling.css" rel="stylesheet">
</head>
<body id="login">
  <nav>
    <!-- logo in the top left -->
    <div class="topnav">
      <div class="topnav-left">
        <a href="projects.html">
          <span class="logo"> Logo </span>
          <!-- <span> <img class="logo" src="imgs/logo.png" alt="ufo logo"> </span> -->
        </a>
      </div>
    </div>

    <!-- reference for sidenav from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav -->
    <!-- reference for making sidenav accessible with tab index https://knowbility.org/blog/2020/accessible-slide-menus/ -->
    <button class="icon-right-justified" onclick="openNav()">&#9776;</button>
    <div id="mySidenav" class="sidenav inactive">
      <a href="javascript:void(0)" role="button" class="closebtn" aria-label="close navigation" onclick="closeNav()">&times;</a>
      <a href="contact.html">contact</a>
      <a href="about.html">about</a>

      <!-- drop down reference from https://stackoverflow.com/questions/35579569/hide-show-menu-onclick-javascript -->
      <button id="menu" class="dropbtn" onclick="toggleMenu()"> projects <i class="small-arrow down"> </i></button>
      <div id="menu-box" class="drop-content">
        <a href="#">login</a>
        <a href="#">register</a>
        <a href="#">home</a>
      </div>
    </div>
  </nav>

 <section class="container-login">
   <!-- <div class="block-login-img">
     <img src="imgs/alien.png" alt="ufo">
   </div> -->

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
          <input class="button-form" type =  "button" value = "Log In" id = "login"/>
          <input class="button-form" type =  "button" value = "Sign Up" id = "sign up"/>
        </div>
        <div class="container-login-buttons">
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </div>
    </div>

        <!-- <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label> -->
      </form>
  </section>

  <!-- <section class="container-login">
    <input class="button-form" type =  "button" value = "Log In" id = "login"/>
  </section> -->

>>>>>>> main
    <script type = "text/javascript">
      $(document).ready(function (){
        $("#login").click(function(){
        var user = $("#user").val();
        var pass = $("#pass").val();
        if(user == "" || pass == "")
          alert('Please check your inputs.');
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
                window.location = 'hidden.php';
            },
            dataType: 'text'
          }
        )
      });
    });
    </script>
<<<<<<< HEAD
=======

  <footer class="section-divider-footer">
    <div class="container-footer">
      <p> ©2021 - Group2 | </p>
      <a class="link" href="#"> citations </a>
      <a class="link" href="#"> database </a>
      <a class="link" href="#"> github </a>
    </div>
  </footer>
>>>>>>> main
</body>
</html>
