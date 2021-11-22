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

echo "<br>";

$description = $_POST['description'];
$timestamp = $_POST['timestamp'];
$upvotes = $_POST['upvotes'];
$commentid = $_POST['commentid'];
$entryid = $_POST['entryid'];

// 'uhhh', '2008-11-11 13:23:44', '3'

//inserting into comments table
$sqlInsert = "INSERT INTO comment (description, timestamp, upvotes)
VALUES" . "(" . $description . "," . "1949-10-10 20:30:00". "," . "0" . ")";

if ($conn->query($sqlInsert) === TRUE) {
  echo "New comment created successfully";
} else {
  echo "Error: " . $sqlInsert . "<br>" . $conn->error;
}
echo "<br>";

//inserting into attached table
// $sqlInsertAttached = "INSERT INTO attached (commentid, entryid)
// VALUES" . "(" . $commentid . "," . $entryid . ")";

// if ($conn->query($sqlInsertAttached) === TRUE) {
//   echo "Inserted commentid and entryid into table successfully";
// } else {
//   echo "Error: " . $sqlInsertAttached . "<br>" . $conn->error;
// }

echo "<a href=" . "'?page=1'" . "name=" . "'link1'> Back to previous posts" . "</a><br>";
if(isset($_GET['page'])){
  header('Location: posts.php');
}

?>

<div class="block-login">
  <form action = "details.php" method = "POST">
    <div class="container-login-logo">
      <img class="logo-img" src="imgs/logo.png" alt="ufo logo">
    </div>
    <p>
      <input class="input-text" type = "text" id ="description" name  = "description" placeholder="Enter description"/>
    </p>
    <!-- <p>
      <input class="input-text" type = "text" id ="timestamp" name  = "timestamp" placeholder="Enter timestamp"/>
    </p> -->
    <div class="container-login-buttons">
      <input class="button-form" type =  "button" value = "Submit" id = "submit"/>
    </div>
</div>

<br>
<a href='logout.php'>LOG OUT</a><br>
