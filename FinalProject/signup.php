<html>
<head>
	<title>Sign Up</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="css/main.css" rel="stylesheet">
</head>
<body>
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

		</div>
	</nav>

	<section class="container-login">
		<div class="block-login">
  	<form action="" method="post">
			<div class="container-login-logo">
				<img class="logo-img" src="imgs/logo.png" alt="ufo logo">
			</div>

      <h1>Sign up. Stay informed. </h1>

      <label for="lastname"><b>First Name</b></label>
      <input class="input-text" type="text" placeholder="Enter First Name" name="firstname" value= "<?php firstName() ?>"> <br> <br>

      <label for="lastname"><b>Last Name</b></label>
      <input class="input-text" type="text" placeholder="Enter Last Name" name="lastname" value= "<?php lastName() ?>"> <br> <br>

      <label for="user"><b>Username</b></label>
      <input class="input-text" type="text" placeholder="Enter Username" name="user" value= "<?php userName() ?>"> <br> <br>

			<label for="phoneNum"><b>Phone Number: </b></label>
      <input class="input-text" type="text" placeholder="Enter Phone Number" name="phoneNum" value= "<?php phoneNum() ?>"> <br> <br>

      <label for="email"><b>Email</b></label>
      <input class="input-text" type="text" placeholder="Enter Email" name="email" value= "<?php email() ?>"> <br> <br>

      <label for="pass"><b>Password</b></label>
      <input class="input-text" type="password" placeholder="Enter Password" name="psw" value= "<?php psw() ?>"> <br> <br>

      <label for="pass-repeat"><b>Repeat Password</b></label>
      <input class="input-text" type="password" placeholder="Repeat Password" name="psw-repeat" value= "<?php pswRepeat() ?>"><br> <br>

			<div class="container-login-buttons">
      	<input class="button-form" type="submit" value="Sign Up" name = "signup"/>
			</div>

    </div>
  </form>
	</div>
</section>
</body>
</html>

<?php
include_once("database.php");
session_start();
function firstName() {
  if (isset($_POST['firstname'])){
		return $_POST['firstname'];
	}
	return "";
}
echo firstName();
function lastName() {
  if (isset($_POST['lastname'])){
		return $_POST['lastname'];
	}
	return "";
}

function userName() {
  if (isset($_POST['user'])){
		return $_POST['user'];
	}
	return "";
}

function phoneNum() {
  if (isset($_POST['phoneNum'])){
		return $_POST['phoneNum'];
	}
	return "";
}

function email() {
  if (isset($_POST['email'])){
		return $_POST['email'];
	}
	return "";
}

function psw() {
  if (isset($_POST['psw'])){
		return $_POST['psw'];
	}
	return "";
}

function pswRepeat() {
  if (isset($_POST['psw-repeat']))
		return $_POST['psw-repeat'];
	return "";
}

function valid()
{
	$count = 0;
	if(userName())
		$count++;
	if(firstName())
		$count++;
	if(lastName())
		$count++;
	if(phoneNum())
		$count++;
	if(email())
		$count++;
	if(psw())
		$count++;
	return $count;
}
//echo valid();
if(valid() >= 6){
$signup = "INSERT INTO member(username, post_count, password, last_name, phone_num, first_name, email) VALUES(
'" . userName() . "',
'0',
'" . pswRepeat() . "',
'" . lastName() . "',
'" . phoneNum() . "',
'" . firstName() . "',
'" . email() . "')";

if ($conn->query($signup) === TRUE) {
  echo "New record created successfully";
	$_SESSION['username'] = userName();
	header( "Location: posts.php" );
} else {
  echo "Error: " . $signup . "<br>" . $conn->error;
}
}
?>
<footer class="section-divider-footer">
	<div class="container-footer">
		<p> ©2021 - Group2 | </p>
		<a class="link" href="login.php"> login </a>
		<a class="link" href="signup.php"> sign up </a>
		<a class="link" href="posts.php"> posts </a>
	</div>
</footer>

<!-- linking javascript file -->
<script src="js/main.js"></script>
</body>
</html>
