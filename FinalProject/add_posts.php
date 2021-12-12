<html>
<head>
	<title>Add Posts</title>
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

      <h1> Add a post. Voice out the truth. </h1>

      <label for="datetime"><b>Date + Time of Encounter (*): </b></label>
      <input class="input-text" type="text" placeholder="Enter Date + Time" name="datetime" value= "<?php echo $_POST['datetime']; ?>"> <br> <br>

      <label for="city"><b>City of Encounter (*): </b></label>
      <input class="input-text" type="text" placeholder="City of Encounter" name="city" value= "<?php echo $_POST['city']; ?>"> <br> <br>

			<label for="countryEncount"><b>Country of Encounter: </b></label>
      <input class="input-text" type="text" placeholder="Country of Encounter" name="countryEncount" value= "<?php echo $_POST['countryEncount']; ?>"> <br> <br>

      <label for="pass"><b>Duration of Encounter (Hrs and Mins):</b></label>
      <input class="input-text" type="text" placeholder="Duration of Encounter" name="durationhrsmins" value= "<?php echo $_POST['durationhrsmins']; ?>"> <br> <br>

			<label for="pass"><b>Duration of Encounter (Secs):</b></label>
      <input class="input-text" type="text" placeholder="Duration of Encounter" name="durationsec" value= "<?php echo $_POST['durationsec']; ?>"> <br> <br>

			<label for="description"><b>Description of Encounter (*): </b></label>
			<input class="input-desc" type="text" placeholder="Enter your description" name="description" value= "<?php echo $_POST['description']; ?>"> <br> <br>

			<div class="container-login-buttons">
				<div class="block-checkboxes">
					<p class="search">Ufo Shape (*):</p>
					<input type="checkbox" id="fireball" name="fireball" value="fireball" <?php if(isset($_POST['fireball'])) echo 'checked="checked"'; ?>>
					<label for="fireball">Fireball</label><br>
					<input type="checkbox" id="disk" name="disk" value="disk"  <?php if(isset($_POST['disk'])) echo 'checked="checked"'; ?>>
					<label for="disk">Disk</label><br>
					<input type="checkbox" id="triangle" name="triangle" value="triangle" <?php if(isset($_POST['triangle'])) echo 'checked="checked"'; ?>>
					<label for="triangle">Triangle</label><br>
					<input type="checkbox" id="circle" name="circle" value="circle" <?php if(isset($_POST['circle'])) echo 'checked="checked"'; ?>>
					<label for="circle">Circle</label><br>
					<input type="checkbox" id="other" name="other" value="other" <?php if(isset($_POST['other'])) echo 'checked="checked"'; ?>>
					<label for="other">Other</label><br>
					<!-- <label class="posts-sort" for="sort-list">Sort by:</label> -->
				</div>
			</div>

			<div class="container-login-buttons">
				<br>
				<div class="test">
					<input class="button-form" type="submit" value="Post" name = "post_entry"/>
				</div>
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
function datetimeEncounter() {
  if (isset($_POST['datetime'])){
		return $_POST['datetime'];
	}
	return "";
}

function countryEncounter() {
  if (isset($_POST['countryEncount'])){
		return $_POST['countryEncount'];
	}
	return "";
}

function cityEncounter() {
  if (isset($_POST['city'])){
		return $_POST['city'];
	}
	return "";
}

function durationHrMinsEncounter() {
  if (isset($_POST['durationhrsmins'])){
		return $_POST['durationhrsmins'];
	}
	return "";
}
function durationSecEncounter() {
  if (isset($_POST['durationsec'])){
		return $_POST['durationsec'];
	}
	return "";
}
function descriptionEncounter() {
  if (isset($_POST['description'])){
		return $_POST['description'];
	}
	return "";
}

function checkDisk()
{
  if(empty($_POST['disk'])){
    return "";
  } else {
    return "disk";
  }
}

function checkFireball()
{
  if(empty($_POST['fireball'])){
    return "";
  } else {
    return "fireball";
  }
}

function checkTriangle()
{
  if(empty($_POST['triangle'])){
    return "";
  } else {
    return "triangle";
  }
}

function checkCircle()
{
  if(empty($_POST['circle'])){
    return "";
  } else {
    return "circle";
  }
}

function checkOther()
{
  if(empty($_POST['other'])){
    return "";
  } else{
    return "other";
  }
}

function shapeOfUfo()
{
	if(checkDisk() != '')
		return checkDisk();

	if(checkFireball() != '')
		return checkFireball();

	if(checkTriangle() != '')
		return checkTriangle();

	if(checkCircle() != '')
		return checkCircle();

	if(checkOther() != '')
		return checkOther();

	return '';
}

function Valid()
{
	$counter = 0;
	if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1)
		$counter++;
	if(shapeOfUfo() != '')
		$counter++;
	if(datetimeEncounter() != '')
		$counter++;
	if(cityEncounter() != '')
		$counter++;
	if(descriptionEncounter() != '')
		$counter++;

	return $counter == 5;
}


	if(Valid()) {
		$user = $_SESSION['username'];
		$datetimeEncounter = datetimeEncounter();
		$countryEncounter = countryEncounter();
		$cityEncounter = cityEncounter();
		$durationsecEncounter = '1sec';
		$durationhrsminsEncounter = durationHrMinsEncounter();
		$descriptionEncounter = descriptionEncounter();
		$shapeOfUfo = shapeOfUfo();
		$longitude = '1';
		$latitude = '1';
		$state = 'a';

		echo $user . "</br>";
		echo $datetimeEncounter . "</br>";
		echo $cityEncounter . "</br>";
		echo $countryEncounter . "</br>";
		echo $durationsecEncounter . "</br>";
		echo $durationhrsminsEncounter . "</br>";
		echo $descriptionEncounter . "</br>";
		echo $shapeOfUfo . "</br>";
		echo $state . "</br>";
		echo $latitude . "</br>";
		echo $longitude . "</br>";

		$stmt = $conn->prepare("INSERT INTO entries(username, datetime, city, state, country, shape, duration_seconds, duration_hrs_mins, comment, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('sssssssssss',
		$user,
		$datetimeEncounter,
		$cityEncounter,
		$state,
		$shapeOfUfo,
		$countryEncounter,
		$durationsecEncounter,
		$durationhrsminsEncounter,
		$descriptionEncounter,
		$longitude,
		$latitude);
		$stmt->execute();


		$entry_id = $conn->insert_id;
		$stmt2 = $conn->prepare("INSERT INTO post_entry(username, entryid) VALUES (?, ?)");
		$stmt2->bind_param("si", $user, $entry_id);
		$stmt2->execute();

		$stmt4 = $conn->prepare("UPDATE member
			SET post_count = post_count + 1
			WHERE username = ?");
		$stmt4->bind_param("s", $user);
		$stmt4 ->execute();
		print_r($stmt4->error_list);
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
