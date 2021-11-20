<html>
<form action="" method="post">
<label for="sort-list">Sort by:</label>

<select name="sort-list" id="sort-list">
  <option value="dateposted_newest" <?php echo (isset($_POST['dateposted_newest']) && $_POST['dateposted_newest'] == 'Newest to oldest') ? 'selected' : ''; ?>>Newest to oldest</option>
  <option value="dateposted_oldest"  <?php echo (isset($_POST['dateposted_oldest']) && $_POST['dateposted_oldest'] == 'Oldest to newest') ? 'selected' : ''; ?>>Oldest to newest</option>
  <option value="most_popular" <?php echo (isset($_POST['most_popular']) && $_POST['most_popular'] == 'Most popular') ? 'selected' : ''; ?>>Most popular</option>
  <option value="least_popular" <?php echo (isset($_POST['least_popular']) && $_POST['least_popular'] == 'Least popular') ? 'selected' : ''; ?>>Least popular</option>
</select>
Shape:
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

<input type="submit" name="button" value="Submit"/></form>
<?php
include_once("database.php");
session_start();
$sql = "SELECT * FROM entries";

function whichSelectOption($option)
{
  if($option == 'dateposted_oldest')
  {
    return " ORDER BY dateposted";
  } else if($option == 'dateposted_newest')
  {
    return " ORDER BY dateposted DESC";
  }
  return " ORDER BY dateposted";
}

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
  } else {
    return true;
  }
}

function howManyShapes()
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
          $sql_statement .= "shape != '" . $other[$x] . "'";
        }
        else{
          $sql_statement .= " AND shape != '" . $other[$x] . "'";
        }
      }
      $sql_statement .= " AND ";
    }
  }

  if($counter > 0)
  {
    for ($x = 0; $x < $counter; $x++) {
      if($x == 0){
        $sql_statement .= "shape = '" . $shapes_include[$x] . "'";
      }
      else{
        $sql_statement .= " OR shape = '" . $shapes_include[$x] . "'";
      }
    }
  }

  if($sql_statement == " WHERE " || (checkFireball() && checkDisk() && checkTriangle() && checkCircle() && checkOther()))
    $sql_statement = "";


  return $sql_statement;
}
$sql .= howManyShapes();

if(isset($_POST['sort-list']))
  $sql .= whichSelectOption($_POST['sort-list']);

echo $sql;
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
