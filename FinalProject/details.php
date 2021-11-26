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
$user = $_SESSION['username'];
echo $entry_id;
$sql = "SELECT * FROM entries WHERE entryid =" . $entry_id;
<<<<<<< HEAD
=======
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
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

        }
    } else {
    echo "0 results";
}
echo "<a href=" . "'?page=1'" . "name=" . "'link1'> Back to previous posts" . "</a><br>";
if(isset($_GET['page'])){
  header('Location: posts.php');
}
$sqlInsert = "INSERT INTO attached (entryid)
VALUES" . "(" .  $entry_id . ")";
$sqlInsert = "INSERT INTO comment (description, timestamp, upvotes)
VALUES ('uhhh', '2008-11-11 13:23:44', '3')";
$resultSql = $conn->query($sqlInsert);
$sqlInsert = "INSERT INTO comment (description, timestamp, upvotes)
VALUES ($description, $timestamp, $upvotes)";
if ($conn->query($sqlInsert) === TRUE) {
  echo "New comment created successfully";
} else {
  echo "Error: " . $sqlInsert . "<br>" . $conn->error;
}
>>>>>>> main

?>
<html>
  <head>
    <title>Detailed View</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>Login Page</title>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <link href="css/styling.css" rel="stylesheet">
  </head>

  <body>
    <nav>
      <!-- logo in the top left -->
      <div class="topnav">
        <div class="topnav-left">
          <a href="projects.html">
            <span class="logo"> Logo </span>
            <!-- <span> <img class="logo" src="imgs/logo.png" alt="ufo logo"> </span> -->
          </a>
        </div>
      </div>

      <!-- reference for sidenav from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav -->
      <!-- reference for making sidenav accessible with tab index https://knowbility.org/blog/2020/accessible-slide-menus/ -->
      <button class="icon-right-justified" onclick="openNav()">&#9776;</button>
      <div id="mySidenav" class="sidenav inactive">
        <a href="javascript:void(0)" role="button" class="closebtn" aria-label="close navigation" onclick="closeNav()">&times;</a>
        <a href="contact.html">contact</a>
        <a href="about.html">about</a>

        <!-- drop down reference from https://stackoverflow.com/questions/35579569/hide-show-menu-onclick-javascript -->
        <button id="menu" class="dropbtn" onclick="toggleMenu()"> projects <i class="small-arrow down"> </i></button>
        <div id="menu-box" class="drop-content">
          <a href="#">login</a>
          <a href="#">register</a>
          <a href="#">home</a>
        </div>
      </div>
    </nav>

  <section class="container-login">

  <?php
    // echo '<section class="container-login">'
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo'<div class="block-login">';
            echo "<h1>Date Posted:" . $row["dateposted"]."</h1><br>";
            echo'<div class="block-login">';
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
            echo'</div>';
            echo'</div>';
            }
        } else {
        echo "0 results";
    }
    ?>

    <?php

    echo "<br>";

    //JANKY ASS COMMENT SECTION MADE BY YOURS TRULY
    $description = $_POST['description'];
    $timestamp = $_POST['timestamp'];
    $upvotes = $_POST['upvotes'];
    $commentid = $_POST['commentid'];
    $entryid = $_POST['entryid'];

    // 'uhhh', '2008-11-11 13:23:44', '3'

    //inserting into comments table
    // $sqlInsert = "INSERT INTO comment (description, timestamp, upvotes)
    // VALUES" . "(" . $description . "," . "1949-10-10 20:30:00". "," . "0" . ")";
    //
    // if ($conn->query($sqlInsert) === TRUE) {
    //   echo "New comment created successfully";
    // } else {
    //   echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    // }
    // echo "<br>";

    //inserting into attached table
    // $sqlInsertAttached = "INSERT INTO attached (commentid, entryid)
    // VALUES" . "(" . $commentid . "," . $entryid . ")";

    // if ($conn->query($sqlInsertAttached) === TRUE) {
    //   echo "Inserted commentid and entryid into table successfully";
    // } else {
    //   echo "Error: " . $sqlInsertAttached . "<br>" . $conn->error;
    // }

    echo "<a class='button-form' href=" . "'?page=1'" . "name=" . "'link1'> Back to previous posts" . "</a><br>";
    if(isset($_GET['page'])){
      header('Location: posts.php');
    }
  ?>

  </section>


  <!-- <div class="block-login">
    <form action = "details.php" method = "POST">
      <div class="container-login-logo">
        <img class="logo-img" src="imgs/logo.png" alt="ufo logo">
      </div>
      <p>
        <input class="input-text" type = "text" id ="description" name  = "description" placeholder="Enter description"/>
      </p>
      <div class="container-login-buttons">
        <input class="button-form" type =  "button" value = "Submit" id = "submit"/>
      </div>
  </div> -->
</body>

  <br>
  <a href='logout.php'>LOG OUT</a><br>
</html>
