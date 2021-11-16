<html>
<head>
	<title>Php Ajax Form Validation Example</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body>
  <form action="signup.php">
    <div class="container">
      <h1>Sign Up</h1>
      <hr>

      <label for="lastname"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname"> <br> <br>

      <label for="lastname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname"> <br> <br>

      <label for="user"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="user"> <br> <br>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email"> <br> <br>

      <label for="pass"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw"> <br> <br>

      <label for="pass-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat"><br> <br>

      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <div class="clearfix">
        <!--- <button type="button" class="cancelbtn">Cancel</button> --->
        <input type =  "button" value = "signup" id = "signup"/>
      </div>
    </div>
  </form>
  <h1>Login</h1>
    <form action = "login.php" method = "POST">
        <p>
          <label> First Name: </label> <input type = "text" id ="user" name  = "user" placeholder="enter username"/>
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
          $('#signup').click(function(){
            //e.preventDefault();
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var user = $("#user").val();
            var email = $("#email").val();
            var pass = $("#psw").val();
            var pass_repeat = $("#psw-repeat").val();
            if(email == "" || firstname == "")
                alert('Please check your inputs.');

          $.ajax(
            {
              type: "POST",
              url: "signup.php",
              dataType: "json",
              data: {
                firstname: firstname,
                lastname: lastname,
                user: user,
                email: email,
                pass: pass,
                pass_repeat: pass_repeat,
                message: message
              }

              success: function (response)
              {
                console.log(response);
              }
            }
          )
        });
      });
      </script>
</body>
</html>

<?php

?>
