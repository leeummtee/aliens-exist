<html>
<head>
	<title>Profile</title>
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

	<section class="container-profile">
		<div class="block-profile">
			<img src="imgs/profile.jpeg" alt="profile pic">
		</div>
		<div class="block-profile">
		<?php
		include_once("database.php"); //Connecting to the database
		session_start();
		//Extracting user information using username as the primary key
		$user = $_SESSION['username'];
		$firstname;
		$lastname;
		$phoneNum;
		$email;
		$post_count;
		$bio;
		$stmt2 = $conn->prepare("SELECT * FROM member WHERE username = ?");
		$stmt2->bind_param("s", $user);
		$stmt2->execute();
		$result = $stmt2->get_result();

		while ($row = $result->fetch_array()) { //Storing user information in variables
			$firstname = $row['first_name'];
			$lastname = $row['last_name'];
			$post_count = $row['post_count'];
			$email = $row['email'];
			$bio = $row['bio'];
		}
		?>
  	<form action="" method="post">
			<?php
			if($firstname != "" || $lastname != "") //Displaying the users first and last name
			{
				echo "<h1> Hey, I'm " . $firstname . " " . $lastname . "</h1>";
			} else {
				echo "<h1>No Name to Display</h1>";
			}

			if($bio != "") //Displaying user bio if there is one
			{
				echo "<p>" . $bio . "</p>";
			}

			//Checking if the user has preferences
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

			if ($prefExists == "1"){ //If preferences exist
				//Extracting preference information from the database
				$city;
				$country;
				$shape;
				$stmt2 = $conn->prepare("SELECT *
				FROM preferences p INNER JOIN set_pref sp ON p.preference_id = sp.preference_id
				WHERE username =  ?");
				$stmt2->bind_param("s", $user);
				$stmt2->execute();
				$result = $stmt2->get_result();
				while ($row = $result->fetch_array()) { //Storing preferences in variables
					$city = $row['city'];
					$country = $row['country'];
					$shape = $row['shape'];
				}
				echo "<h4>My preferences include:</h4>";
				echo "<ul>";
				if($city != "") //If there is a city to display, display the city
				{
					echo "<li>City: " . $city . "</il>";
				}
				if($country != "") //If there is a country to display, display the country
				{
					echo "<li>Country: " . $country . "</il>";
				}
				if($shape != "") //If there are shapes to display, display the shapes
				{
					$shapes = "";
					$fireball = " , fireball";
					$circle= " , circle";
					$disk = " , disk";
					$triangle = " , triangle";
					$other = " , other";
					if(strpos($shape, "circle") != false){
						$shapes .= $circle;
					}

					if(strpos($shape, "disk") != false){
						$shapes .= $disk;
					}

					if(strpos($shape, "fireball") != false)
					{
						$shapes .= $fireball;
					}

					if(strpos($shape, "other") != false)
					{
						$shapes .= $other;
					}
					$finalshapes = substr($shapes, 3);
					echo "<li>UFO Shapes: " . $finalshapes .  "</il>";
				}
				echo "</ul>";
			} else { //If there are no preferences
				echo "<h4>No preferences set</h4>";
			}
			echo "<h4>Profile statistics:</h4>";
			echo "<ul>";
			if($post_count != "") //Displaying post count
			{
				echo "<li>Post Count: " . $post_count . "</il>";
			} else
			{
				echo "<li>Post Count:  0 </il>";
			}
			echo "</ul>";
			?>

			<div class="container-login-buttons">
				<br>
				<div class="test">
					<a class="button-nav" href="edit_profile.php"> Edit Profile </a>
				</div>
			</div>

    </div>
  </form>
	</div>
</section>
</body>
</html>

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
