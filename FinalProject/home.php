<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title> Home </title>
  <link href="css/main.css" rel="stylesheet">
  <!-- <link href="css/queries.css" rel="stylesheet"> -->
  <!-- linking the fade animations that must be loaded in header -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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

  <section class="container-header">
    <div class="block">
      <header class="header-text-detailed">
        <h1 id="project-header"> UFO encounters for you.</h1>
        <p> The latest posts filtered by your preferences. </p>
        <!-- down arrow reference: https://www.w3schools.com/howto/howto_css_arrows.asp -->
        <p><i class="arrow down"></i></p>
      </header>
    </div>
  </section>

  <?php
  include_once("database.php"); //Connecting to the database
  session_start();
  $sql_statement = "";
  function defaultSetting() //If the user has no preferences or is a visitor
  {
    return "SELECT * FROM entries ORDER BY dateposted DESC LIMIT 6";
  }

  if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1) //If the user is logged in
  {
    //Checking if the user has preferences or not
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
    if($prefExists == "1") //If the user has preferences
    {
      $user = $_SESSION['username'];
      //Extracting all the user preferences from the database
      $stmt_get_pref = $conn->prepare("SELECT country, city, shape, upvotes FROM
      preferences INNER JOIN set_pref ON preferences.preference_id = set_pref.preference_id
      WHERE username =  ?");
      $stmt_get_pref->bind_param("s", $user);

      $stmt_get_pref->execute();
      $city = '';
      $country = '';
      $shape = '';
      $upvotes = '';

      $result = $stmt_get_pref->get_result();
      while ($row = $result->fetch_array()) { //Saving out put from preferences
          $city = $row['city'];
          $country = $row['country'];
          $shape = $row['shape'];
          $country = $row['upvotes'];
        }
      $sql_statement = "SELECT * FROM entries";

      $imgIncrementer = 2;
      if($shape != '') //If there are image shape preferences, print the 6 lastest posts
      {
        $sql_statement .= $shape . " ORDER BY dateposted DESC LIMIT 6";
        $result_records = $conn->query($sql_statement);
        ?>
        <h1 class="block-for-you"> Shapes </h1>
        <section class="container-for-you">
        <?php
        if ($result_records->num_rows > 0) {
          while($row = $result_records->fetch_assoc()) {
            echo '<div class="block-for-you">';
            echo '<a><img class="home-listing" src="imgs/ufo2.png" alt="ufo"></a>';
            echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
            echo "</div>";
            if(isset($_GET['link'])){
              //echo "uh";
              $_SESSION['entryid'] = $_GET['link'];
              header("Location: details.php");
            }
          }
        } else {
           echo "No results were found </br>";
        }
        echo '</section>';
      }

      echo '<br> <br>';

      if($country != '') //If there are country preferences, print the 6 lastest posts
      {
        $stmt = $conn->prepare("SELECT * FROM entries WHERE country = ? ORDER BY dateposted DESC LIMIT 6");
        $stmt->bind_param("s", $country);
        $stmt->execute();
        $results = $stmt->get_result();
        ?>
        <h1 class="block-for-you"> Country </h1>
        <section class="container-for-you">
        <?php
        if($results != null && $results->num_rows > 0){
          if ($results->num_rows > 0) {
            while($row = $results->fetch_assoc()) {
              echo '<div class="block-for-you">';
              echo '<a><img class="home-listing" src="imgs/ufo3.jpeg" alt="ufo"></a>';
              echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
              echo "</div>";
              if(isset($_GET['link'])){
                //echo "uh";
                $_SESSION['entryid'] = $_GET['link'];
                header("Location: details.php");
              }
            }
          }
        } else {
           echo "No results were found </br>";
        }
        echo '</section>';
      }

      echo '<br> <br>';

      if($city != '') //If there are city preferences, print the 6 lastest posts
      {
        $stmt2 = $conn->prepare("SELECT * FROM entries WHERE city = ? ORDER BY dateposted DESC LIMIT 6");
        $stmt2->bind_param("s", $city);
        $stmt2->execute();
        $result = $stmt2->get_result();
        ?>
        <h1 class="block-for-you"> City </h1>
        <section class="container-for-you">
        <?php
        if($result != null && $result->num_rows > 0){
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<div class="block-for-you">';
              echo '<a><img class="home-listing" src="imgs/ufo4.png" alt="ufo"></a>';
              echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
              echo "</div>";
              if(isset($_GET['link'])){
                //echo "uh";
                $_SESSION['entryid'] = $_GET['link'];
                header("Location: details.php");
              }
            }
          }
        } else {
           echo "<p>No results were found <p></br>";
        }
        echo '</section>';
      }

      if($city == '' && $country == '' && $shape == '') //If all preferences are empty, print the 6 latest posts
      {
        $sql_statement = defaultSetting();
        $result_records = $conn->query($sql_statement);
        echo '<h1 class="block-for-you"> Newest Posts </h1>';
        echo '<section class="container-for-you">';
        if ($result_records->num_rows > 0) {
          while($row = $result_records->fetch_assoc()) {
            echo '<div class="block-for-you">';
            echo '<a><img class="home-listing" src="imgs/ufo5.png" alt="ufo"></a>';
            echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
            echo "</div>";
            if(isset($_GET['link'])){
              //echo "uh";
              $_SESSION['entryid'] = $_GET['link'];
              header("Location: details.php");
            }
          }
        }
        echo '</section>';
      }
    } else { //Print the lastest posts if there are no preferences
      $sql_statement = defaultSetting();
      $result_records = $conn->query($sql_statement);
      echo '<h1 class="block-for-you"> Newest Posts </h1>';
      echo '<section class="container-for-you">';
      if ($result_records->num_rows > 0) {
        while($row = $result_records->fetch_assoc()) {
          echo '<div class="block-for-you">';
          echo '<a><img class="home-listing" src="imgs/ufo5.png" alt="ufo"></a>';
          echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
          echo "</div>";
          if(isset($_GET['link'])){
            //echo "uh";
            $_SESSION['entryid'] = $_GET['link'];
            header("Location: details.php");
          }
        }
      }
      echo '</section>';
    }
  } else { //Print the lastest posts if they are not a member
    $sql_statement = defaultSetting();
    $result_records = $conn->query($sql_statement);
    echo '<h1 class="block-for-you"> Newest Posts </h1>';
    echo '<section class="container-for-you">';
    if ($result_records->num_rows > 0) {
      while($row = $result_records->fetch_assoc()) {
        echo '<div class="block-for-you">';
        echo '<a><img class="home-listing" src="imgs/ufo5.png" alt="ufo"></a>';
        echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
        echo "</div>";
        if(isset($_GET['link'])){ //Go to the post if clicked on
          $_SESSION['entryid'] = $_GET['link'];
          header("Location: details.php");
        }
      }
    }
    echo '</section>';
  }
  ?>
  <footer class="section-divider-footer">
  	<div class="container-footer">
  		<p> ??2021 - Group2 | </p>
  		<a class="link" href="login.php"> login </a>
  		<a class="link" href="signup.php"> sign up </a>
  		<a class="link" href="posts.php"> posts </a>
  	</div>
  </footer>

  <!-- linking the animation library  -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <!-- linking javascript file -->
  <script src="js/main.js"></script>
</body>
</html>
