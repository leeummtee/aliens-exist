<html>
  <head>
    <title>Detailed View</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>Details Page</title>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <link href="css/main.css" rel="stylesheet">
  </head>

  <body id="details">
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

    <section class="padding-detailed">

    <?php

    include_once("database.php"); //Connecting to the database
    session_start();

    function userValidation($name) //Checking if there is a user attached to the post or not
    {
      if($name == "")
        return "anonymous";
      return $name;
    }

    $entry_id = $_SESSION['entryid']; //Obtaining entry id

    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1 && isset($_POST['comment_desc'])) //Checking if user is logged in and there is a comment description
    {
      //Adding comment to the database
      $user = $_SESSION['username'];
      $stmt = $conn->prepare("INSERT INTO comment(description) VALUES (?)");
      $stmt->bind_param("s", $description);
      $description = $_POST['comment_desc'];
      $stmt->execute();

      //Adding comment to the relationship table between user and comment
      $comment_id1 = $conn->insert_id;
      $stmt2 = $conn->prepare("INSERT INTO post_comment(username, commentid) VALUES (?, ?)");
      $stmt2->bind_param("si", $user, $comment_id);
      $user = $_SESSION['username'];
      $comment_id = $comment_id1;
      $stmt2->execute();

      //Adding comment to the relationship table between entry and comment
      $stmt3 = $conn->prepare("INSERT INTO attached(entryid, commentid) VALUES (?, ?)");
      $stmt3->bind_param("si", $entry_id, $comment_id);
      $stmt3->execute();
    }

    $sql = "SELECT * FROM entries WHERE entryid =" . $entry_id;

    echo '<section class="container-profile">';
    $result = $conn->query($sql); //Getting results of entry from query
    if ($result->num_rows > 0) {
        //Outputting data from each column of the entry row
        while($row = $result->fetch_assoc()) {
            echo '<div class="block-profile">';
            echo "<h1>Date Posted:";
            echo $row["dateposted"]."</h1><br>";
            echo "<strong>Author</strong>: " . userValidation($row["username"])."<br>";
            echo "<strong>Country:</strong> " . $row["country"]."<br>";
            echo "<strong>City</strong>: " . $row["city"]."<br>";
            echo "<strong>State:</strong> " . $row["state"]."<br>";
            echo "<strong>Shape:</strong> " . $row["shape"]."<br>";
            echo "<strong>Latitude:</strong> " . $row["latitude"]."<br>";
            echo "<strong>Longitude:</strong> " . $row["longitude"]."<br>";
            echo "<strong>Date and Time of Occurance:</strong> " . $row["datetime"]."<br>";
            echo "<strong>Duration (secs): </strong>" . $row["duration_seconds"]."<br>";
            echo "<strong>Duration (hrs and mins): </strong>" . $row["duration_hrs_mins"]."<br>";
            echo "<strong>Description:</strong>" . $row["comment"]."<br>";
            echo "</div>";
            }
        } else {
        echo "0 results";
    }
    ?>

    <div class="block-profile">
      <img src="imgs/ufo2.1.png" alt="profile pic">
    </div>
  </section>

    <?php
    //Obtaining comments attached to the entry
    $sql2 = "SELECT * FROM attached a
    INNER JOIN comment c
    ON a.commentid = c.commentid
    INNER JOIN post_comment pc
    ON c.commentid = pc.commentid
    WHERE entryid = " . $entry_id;

    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        //Printing out comments
        while($row = $result2->fetch_assoc()) {
          echo '<div class="block-for-you">';
          echo "<br> Time Posted:" . $row["timestamp"]."<br>";
          echo "Upvotes:" . $row["upvotes"]."<br>";
          echo "User:" . $row["username"]."<br>";
          echo "Description:" . $row["description"]."<br>";
          echo '<div>';
        }
      }
      else {
        echo "No comments currently";
      }

    echo "<a href=" . "'?page=1'" . "name=" . "'link1'> Back to previous posts" . "</a><br>";
    if(isset($_GET['page'])){
      header('Location: posts.php');
    }

    // echo '</section>';
    ?>
  </section>

  <section class="container-login">
    <form action = "details.php" method = "POST">
      <p>
        <input class="input-desc" type = "text" id ="comment_desc" name  = "comment_desc" placeholder="Enter Comment"/>
      </p>
        <input class="button-form" type="submit" value="post" name = "post"/>
    </nav>
    </form>
  </section>

  <!-- linking javascript file -->
  <script src="js/main.js"></script>

</body>
<footer class="section-divider-footer">
  <div class="container-footer">
    <p> ©2021 - Group2 | </p>
    <a class="link" href="login.php"> login </a>
    <a class="link" href="signup.php"> sign up </a>
    <a class="link" href="posts.php"> posts </a>
  </div>
</footer>
</html>
