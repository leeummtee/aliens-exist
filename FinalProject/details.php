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

    <section class="padding-detailed">

    <?php

    include_once("database.php");
    session_start();

    function userValidation($name)
    {
      if($name == "")
        return "anonymous";
      return $name;
    }

    $entry_id = $_SESSION['entryid'];
    function phoneNum() {
      if (isset($_POST['phoneNum'])){
    		return $_POST['phoneNum'];
    	}
    	return "";
    }

    if(isset($_POST['comment_desc']))
    echo "yo";

    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1 && isset($_POST['comment_desc']))
    {
      $user = $_SESSION['username'];

      $stmt = $conn->prepare("INSERT INTO comment(description) VALUES (?)");
      $stmt->bind_param("s", $description);
      $description = $_POST['comment_desc'];
      $stmt->execute();

      $comment_id1 = $conn->insert_id;
      $stmt2 = $conn->prepare("INSERT INTO post_comment(username, commentid) VALUES (?, ?)");
      $stmt2->bind_param("si", $user, $comment_id);
      $user = $_SESSION['username'];
      $comment_id = $comment_id1;
      $stmt2->execute();

      $stmt3 = $conn->prepare("INSERT INTO attached(entryid, commentid) VALUES (?, ?)");
      $stmt3->bind_param("si", $entry_id, $comment_id);
      $stmt3->execute();


      //UPDATE member
      //SET post_count = post_count + 1
      //WHERE username = 'a';
    //  echo mysqli_insert_id();
    }
    // echo $entry_id;
    $sql = "SELECT * FROM entries WHERE entryid =" . $entry_id;

    // echo '<section class="container-posts">';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // echo '<div class="block-posts">';
            echo "<h1>Date Posted:" . $row["dateposted"]."</h1><br>";
            echo "Author: " . userValidation($row["username"])."<br>";
            echo "Country: " . $row["country"]."<br>";
            echo "City: " . $row["city"]."<br>";
            echo "State: " . $row["state"]."<br>";
            echo "Shape: " . $row["shape"]."<br>";
            echo "Latitude: " . $row["latitude"]."<br>";
            echo "Longitude: " . $row["longitude"]."<br>";
            echo "Date and Time of Occurance: " . $row["datetime"]."<br>";
            echo "Duration (secs): " . $row["duration_seconds"]."<br>";
            echo "Duration (hrs and mins): " . $row["duration_hrs_mins"]."<br>";
            echo "Description: " . $row["comment"]."<br>";
            // echo "</div>";

            // img
            // echo '<div class="block-posts">';
            // echo'<a href="#"><img src="imgs/ufo.webp" alt="ufo"></a>';
            // echo '</div>';
            }
        } else {
        echo "0 results";
    }


    $sql2 = "SELECT * FROM attached a
    INNER JOIN comment c
    ON a.commentid = c.commentid
    INNER JOIN post_comment pc
    ON c.commentid = pc.commentid
    WHERE entryid = " . $entry_id;

    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row = $result2->fetch_assoc()) {
          echo "<br> Time Posted:" . $row["timestamp"]."<br>";
          echo "Upvotes:" . $row["upvotes"]."<br>";
          echo "User:" . $row["username"]."<br>";
          echo "Description:" . $row["description"]."<br>";
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

  <?php
    // echo '<section class="container-posts">';
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo'<div class="block-login">';
    //         echo "<h1>Date Posted:" . $row["dateposted"]."</h1><br>";
    //         echo'<div class="block-login">';
    //         echo "Author: " . userValidation($row["username"])."<br>";
    //         echo "Country: " . $row["country"]."<br>";
    //         echo "City: " . $row["city"]."<br>";
    //         echo "State: " . $row["state"]."<br>";
    //         echo "Shape: " . $row["shape"]."<br>";
    //         echo "Latitude: " . $row["latitude"]."<br>";
    //         echo "Longitude: " . $row["longitude"]."<br>";
    //         echo "Date and Time of Occurance: " . $row["datetime"]."<br>";
    //         echo "Duration (secs): " . $row["duration_seconds"]."<br>";
    //         echo "Duration (hrs and mins): " . $row["duration_hrs_mins"]."<br>";
    //         echo "Description: " . $row["comment"]."<br>";
    //         echo'</div>';
    //         echo'</div>';
    //         }
    //     } else {
    //     echo "0 results";
    //     echo '</section>';
    // }
    // ?>

    <?php
    //
    // echo "<br>";
    //
    // //JANKY ASS COMMENT SECTION MADE BY YOURS TRULY
    // $description = $_POST['description'];
    // $timestamp = $_POST['timestamp'];
    // $upvotes = $_POST['upvotes'];
    // $commentid = $_POST['commentid'];
    // $entryid = $_POST['entryid'];
    //
    // echo "<a class='button-form' href=" . "'?page=1'" . "name=" . "'link1'> Back to previous posts" . "</a><br>";
    // if(isset($_GET['page'])){
    //   header('Location: posts.php');
    // }
  ?>

  <form action = "details.php" method = "POST">
    <p>
      <input class="comment-text" type = "text" id ="comment_desc" name  = "comment_desc" placeholder="Enter Comment"/>
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
