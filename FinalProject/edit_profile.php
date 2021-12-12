<html>
<head>
	<title>Edit Profile</title>
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
		<div class="block-edit">
  	<form action="" method="post" enctype="multipart/form-data">
			<div class="container-login-logo">
				<img class="logo-img" src="imgs/logo.png" alt="ufo logo">
			</div>

      <div class="form-title">
          <h1> Edit your profile. </h1>
      </div>
		</br>
			<label for="lastname"><b>Profile Picture</b></label> </br>
			<input type="file" name="file"> </br></br>

      <label for="lastname"><b>First Name</b></label>
      <input class="input-text" type="text" placeholder="Enter First Name" name="firstname" value= "<?php echo firstName(); ?>"> <br> <br>

      <label for="lastname"><b>Last Name</b></label>
      <input class="input-text" type="text" placeholder="Enter Last Name" name="lastname" value= "<?php echo lastName(); ?>"> <br> <br>

      <label for="user"><b>Username</b></label>
      <input class="input-text" type="text" placeholder="Enter Username" name="user" value= "<?php echo userName(); ?>"> <br> <br>

			<label for="phoneNum"><b>Phone Number: </b></label>
      <input class="input-text" type="text" placeholder="Enter Phone Number" name="phoneNum" value= "<?php echo phoneNum(); ?>"> <br> <br>

      <label for="pass"><b>Password</b></label>
      <input class="input-text" type="password" placeholder="Enter Password" name="psw" value= "<?php echo psw(); ?>"> <br> <br>

      <label for="pass-repeat"><b>Repeat Password</b></label>
      <input class="input-text" type="password" placeholder="Repeat Password" name="psw-repeat" value= "<?php echo pswRepeat(); ?>"><br> <br>

      <label for="lastname"><b>Your Bio: </b></label>
      <input class="input-desc" type="text" placeholder="Enter Bio" name="bio" value= "<?php echo bio(); ?>"> <br>
			<div class="container-login-buttons">
      	<input class="button-form" type="submit" value="Submit Changes" name = "signup"/>
			</div>

    </div>
  </form>
	</div>
</section>
</body>
</html>

<?php
include_once("database.php"); //Connecting to the database
session_start(); //Starting session
function firstName() { //Function to check if first name has been input or not
  if (isset($_POST['firstname'])){
		return $_POST['firstname'];
	}
	return "";
}

function lastName() { //Function to check if last name has been input or not
  if (isset($_POST['lastname'])){
		return $_POST['lastname'];
	}
	return "";
}

function userName() { //Function to check if the username has been input or not
  if (isset($_POST['user'])){
		return $_POST['user'];
	}
	return "";
}

function phoneNum() { //Function to check if phone number has been input or not
  if (isset($_POST['phoneNum'])){
		return $_POST['phoneNum'];
	}
	return "";
}

function bio() { //Function to check if the bio has been input or not
  if (isset($_POST['bio'])){
		return $_POST['bio'];
	}
	return "";
}

function psw() { //Function to check if password has been input or not
  if (isset($_POST['psw'])){
		return $_POST['psw'];
	}
	return "";
}

function pswRepeat() { //Function to check if password has been input or not
  if (isset($_POST['psw-repeat']))
		return $_POST['psw-repeat'];
	return "";
}

$user = $_SESSION['username'];

if(firstName() != ""){ //Changing first name if there is input
	$user = $_SESSION['username'];
	$firstname = firstName();
$stmt2 = $conn->prepare( "UPDATE member
SET first_name = ?
WHERE username = ?");
$stmt2->bind_param("ss", $firstname, $user);
$stmt2->execute();
}

if(lastName() != ""){ //Changing last name if there is input
	$user = $_SESSION['username'];
	$lastname = lastName();
$stmt2 = $conn->prepare( "UPDATE member
SET last_name = ?
WHERE username = ?");
$stmt2->bind_param("ss", $lastname, $user);
$stmt2->execute();
}


if(phoneNum() != ""){ //Changing phone number if there is input
	$user = $_SESSION['username'];
	$phone = phoneNum();
$stmt2 = $conn->prepare( "UPDATE member
SET phone_num = ?
WHERE username = ?");
$stmt2->bind_param("ss", $phone, $user);
$stmt2->execute();
}

if(psw() != "" && psw() == pswRepeat()){ //Changing password if there is input and they are the same
	$user = $_SESSION['username'];
	$pass = psw();
$stmt2 = $conn->prepare( "UPDATE member
SET password = ?
WHERE username = ?");
$stmt2->bind_param("ss", $pass, $user);
$stmt2->execute();
}

if(bio() != ""){ //Changing bio if there is input
	$user = $_SESSION['username'];
	$bio = bio();
$stmt2 = $conn->prepare( "UPDATE member
SET bio = ?
WHERE username = ?");
$stmt2->bind_param("ss", $bio, $user);
$stmt2->execute();
}

if(userName() != ""){ //Changing username if there is input
	$user = $_SESSION['username'];
	$username = userName();
	$stmt2 = $conn->prepare( "UPDATE member
	SET username = ?
	WHERE username = ?");
	$stmt2->bind_param("ss", $username, $user);
	if($stmt2->execute()){
		$_SESSION['username'] = $username;
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
