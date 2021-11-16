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
</body>
</html>
