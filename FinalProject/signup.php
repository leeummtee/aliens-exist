<html>
<head>
	<title>Php Ajax Form Validation Example</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body>
  <form action="" method="post">
      <h1>Sign Up</h1>
      <hr>

      <label for="lastname"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname" value= "<?php firstName() ?>"> <br> <br>

      <label for="lastname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname" value= "<?php lastName() ?>"> <br> <br>

      <label for="user"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="user" value= "<?php userName() ?>"> <br> <br>

			<label for="phoneNum"><b>Phone Number: </b></label>
      <input type="text" placeholder="Enter Phone Number" name="phoneNum" value= "<?php phoneNum() ?>"> <br> <br>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" value= "<?php email() ?>"> <br> <br>

      <label for="pass"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" value= "<?php psw() ?>"> <br> <br>

      <label for="pass-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" value= "<?php pswRepeat() ?>"><br> <br>

      <input type="submit" value="signup" name = "signup"/>
    </div>
  </form>
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
echo valid();
if(valid() >= 6){
$signup = "INSERT INTO member(username, password, last_name, phone_num, first_name, email) VALUES(
'" . userName() . "',
'" . pswRepeat() . "',
'" . lastName() . "',
'" . phoneNum() . "',
'" . firstName() . "',
'" . email() . "')";

if ($conn->query($signup) === TRUE) {
  echo "New record created successfully";
	$_SESSION['username'] = userName();
} else {
  echo "Error: " . $signup . "<br>" . $conn->error;
}
}
?>
