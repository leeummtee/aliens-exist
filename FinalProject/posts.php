<html>
<form action="" method="post">
<label for="sort-list">Sort by:</label>

<select name="sort-list" id="sort-list">
  <option value="dateposted_oldest">Oldest to newest</option>
  <option value="dateposted_newest">Newest to oldest</option>
  <option value="most_popular">Most popular</option>
  <option value="least_popular">Least popular</option>
</select>
<input type="submit" name="button" value="Submit"/></form>

<?php
include_once("database.php");
session_start();
$sql = "SELECT * FROM entries ORDER BY dateposted DESC";

if(isset($_POST['sort-list']))
  $sql = whichSelectOption($_POST['sort-list']);

function whichSelectOption($option)
{
  if($option == 'dateposted_oldest')
  {
    return "SELECT * FROM entries ORDER BY dateposted DESC";
  } else if($option == 'dateposted_newest')
  {
    return "SELECT * FROM entries ORDER BY dateposted";
  }
  return "SELECT * FROM entries ORDER BY dateposted DESC";
}
//$sql = "SELECT * FROM entries ORDER BY dateposted";
//$sql = "SELECT * FROM entries ORDER BY datetime DESC";
//$sql = "SELECT * FROM entries ORDER BY datetime";
//$sql = least + most popularity to be added

//$sql = "";
//$sql = "SELECT * FROM entries WHERE shape =" . $shape;
//$sql = ""
function howManyShapes()
{

}

$result = $conn->query($sql);
$count = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($count < 10){
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
        $count++;
        }
    }
} else {
    echo "0 results";
}

function userValidation($name)
{
  if($name == "")
    return "anonymous";
  return $name;
}

?>
