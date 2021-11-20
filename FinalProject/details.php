<?php
include_once("database.php");
session_start();

function userValidation($name)
{
  if($name == "")
    return "anonymous";
  return $name;
}

$var_value = $_SESSION['entryid'];
echo $var_value;
$sql = "SELECT * FROM entries WHERE entryid =" . $var_value;
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
echo "<a href=" . "'posts.php'" . "name=" . "'link1'> Back to previous posts" . "</a><br>";
?>
