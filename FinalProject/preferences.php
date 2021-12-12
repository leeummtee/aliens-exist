<?php
include_once("database.php"); //Connecting to the database
session_start();

function city() { //Function to check if there is a city input
  if (isset($_POST['city'])){
		return $_POST['city'];
	}
	return "";
}

function country() { //Function to check if there is a country input
  if (isset($_POST['country'])){
		return $_POST['country'];
	}
	return "";
}

//Checking all the shapes
function checkDisk()
{
  if(empty($_POST['disk'])){
    return "";
  } else {
    return true;
  }
}

function checkFireball()
{
  if(empty($_POST['fireball'])){
    return "";
  } else {
    return true;
  }
}

function checkTriangle()
{
  if(empty($_POST['triangle'])){
    return "";
  } else {
    return true;
  }
}

function checkCircle()
{
  if(empty($_POST['circle'])){
    return "";
  } else {
    return true;
  }
}

function checkOther()
{
  if(empty($_POST['other'])){
    return "";
  } else{
    return true;
  }
}

function upvotes()
{
  if(empty($_POST['upvotes'])){
    return false;
  } else{
    return true;
  }
}


function howManyShapes() //Writing a statement to save all the shapes
{
  $shapes_include = array();
  $sql_statement = " WHERE ";
  $other = array();
  $counter = 0;

  if(checkFireball())
  {
    $shapes_include[$counter] = "fireball";
    $counter++;
  }

  if(checkDisk())
  {
    $shapes_include[$counter] = "disk";
    $counter++;
  }
  if(checkTriangle())
  {
    $shapes_include[$counter] = "triangle";
    $counter++;
  }
  if(checkCircle())
  {
    $shapes_include[$counter] = "circle";
    $counter++;
  }
  if(checkOther())
  {
    $count = 0;
    if(checkFireball() == ""){
      $other[$count] = "fireball";
      $count++;
    }
    if(checkDisk() == ""){
      $other[$count] = "disk";
      $count++;
    }
    if(checkTriangle() == ""){
      $other[$count] = "triangle";
      $count++;
    }
    if(checkCircle() == ""){
      $other[$count] = "circle";
      $count++;
    }
    if($count > 0) {
      for ($x = 0; $x < $count; $x++) {
        if($x == 0){
          $sql_statement .= "(shape != '" . $other[$x] . "'";
        }
        else{
          $sql_statement .= " AND shape != '" . $other[$x] . "'";
        }
      }
      if($counter > 0)
        $sql_statement .= " AND ";
    }
  }

  if($counter > 0)
    {
      for ($x = 0; $x < $counter; $x++) {
        if($x == 0){
          $sql_statement .= "(shape = '" . $shapes_include[$x] . "'";
        }else if($x == ($counter -1))
        {
          $sql_statement .= " OR shape = '" . $shapes_include[$x] . "')";
        }else{
          $sql_statement .= " OR shape = '" . $shapes_include[$x] . "'";
        }
      }
    }
    if($counter == 1)
    {
      $sql_statement .= ")";
    }
    if($sql_statement == " WHERE " || (checkFireball() && checkDisk() && checkTriangle() && checkCircle() && checkOther()))
      $sql_statement = "";
    return $sql_statement;
  }

if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1) //Checking if the user is logged in
{
  $user = $_SESSION['username'];
  $stmt = $conn->prepare("SELECT EXISTS(
         SELECT *
         FROM set_pref
         WHERE username = ?)");
  $stmt->bind_param("s", $user);
  $stmt->execute();
  $result = $stmt->get_result();
  $prefExists = "0";
  while ($row = $result->fetch_array()) {
      foreach ($row as $r) {
          if($r == 0){
            $prefExists = "0";
          }
          else {
            $prefExists = "1";
          }
      }
  }

  if($prefExists == "1")
  {
      $user = $_SESSION['username'];
    $stmt2 = $conn->prepare("SELECT p.preference_id
    FROM preferences p INNER JOIN set_pref sp ON p.preference_id = sp.preference_id
    WHERE username =  ?");
    $stmt2->bind_param("s", $user);
    $stmt2->execute();
    $preference_id;
    $result = $stmt2->get_result();
    while ($row = $result->fetch_array()) {
        foreach ($row as $r) {
          $preference_id = $r;
        }
      }
  $country = country();
  $city = city();
  $upvotes = upvotes();
  $shapes = howManyShapes();
  $update = "UPDATE preferences SET ";

  $stmt2 = $conn->prepare("UPDATE preferences SET
    country = ?, city = ?, shape = ?, upvotes = ?
    WHERE preference_id = ?");
  $stmt2->bind_param("sssss", $country, $city, $shapes, $upvotes, $preference_id);
  $stmt2->execute();
  print_r($stmt2->error_list);
  } else {
    $user = $_SESSION['username'];
    $country = country();
    $city = city();
    $upvotes = upvotes();
    $shapes = howManyShapes();
    echo $user . "</br>";
    echo $country . "</br>";
    echo $city . "</br>";
    echo $upvotes . "</br>";
    echo $shapes . "</br>";

    $stmt2 = $conn->prepare("INSERT INTO preferences(country, city, shape, upvotes) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("ssss", $country, $city, $shapes, $upvotes);
    $stmt2->execute();
    print_r($stmt2->error_list);
    $pref_id = $conn->insert_id;

    $stmt3 = $conn->prepare("INSERT INTO set_pref(username, preference_id) VALUES (?, ?)");
    $stmt3 ->bind_param("ss", $user, $pref_id);
    $stmt3 ->execute();
    print_r($stmt3->error_list);
  }
}

if(isset($_POST['setpref'])) //Head to home page once preferences are set
{
  header('Location: home.php');
}
?>

<html>
<head>
	<title>Preferences</title>
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

      <h1> Set Preferences </h1>
      <label for="city"><b>City: </b></label>
      <input class="input-text" type="text" placeholder="City of Encounter" name="city" value= "<?php echo city(); //if(isset($_POST['city'])) echo $_POST['city']; ?>"> <br> <br>

			<label for="country"><b>Country: </b></label>
      <input class="input-text" type="text" placeholder="Country of Encounter" name="country" value= "<?php echo country(); ?>"> <br> <br>


				<div class="block-checkboxes">
					<p class="search">Ufo Shape:</p>
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

      <div class="block-checkboxes">
        <p class="search">UpVotes:</p>
        <input type="checkbox" id="upvotes" name="upvotes" value="upvotes" <?php if(isset($_POST['fireball'])) echo 'checked="checked"'; ?>>
        <label for="upvotes"></label><br>
      </div>
			<div class="container-login-buttons">
				<br>
				<div class="test">
					<input class="button-form" type="submit" value="Set" name = "setpref"/>
				</div>
			</div>

    </div>
  </form>
	</div>
</section>
</body>
</html>
