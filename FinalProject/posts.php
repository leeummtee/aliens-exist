<html>
<form action="" method="post">
<label for="sort-list">Sort by:</label>

<select name="sort-list" id="sort-list">
  <option value="dateposted_newest" <?php echo (isset($_POST['dateposted_newest']) && $_POST['dateposted_newest'] == 'Newest to oldest') ? 'selected' : ''; ?>>Newest to oldest</option>
  <option value="dateposted_oldest"  <?php echo (isset($_POST['dateposted_oldest']) && $_POST['dateposted_oldest'] == 'Oldest to newest') ? 'selected' : ''; ?>>Oldest to newest</option>
  <option value="most_popular" <?php echo (isset($_POST['most_popular']) && $_POST['most_popular'] == 'Most popular') ? 'selected' : ''; ?>>Most popular</option>
  <option value="least_popular" <?php echo (isset($_POST['least_popular']) && $_POST['least_popular'] == 'Least popular') ? 'selected' : ''; ?>>Least popular</option>
</select>
<br>
Shape:
<br>
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
//$_SESSION['page'] = 0;
if(!isset($_SESSION['page'])){
  $_SESSION['page'] = 0;
}
echo "page" . $_SESSION['page'];

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
  if($_SESSION['test']){
    $_SESSION['test'] = false;
    return true;
  }
  if(empty($_POST['other'])){
    return "";
  } else{
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
      if($counter > 0)
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

function userValidation($name)
{
  if($name == "")
    return "anonymous";
  return $name;
}

?>

<?php
$entry_records = "SELECT COUNT(*) AS num_of_records FROM entries";
$num_of_entry_records;
$page = $_SESSION['page'];
$per_page = 10;
$offset=$page*$per_page; //2
$result_records = $conn->query($entry_records);
if ($result_records->num_rows > 0) {
  while($row = $result_records->fetch_assoc()) {
    $num_of_entry_records = $row["num_of_records"];
    echo $num_of_entry_records;
  }
}
$max_page = $num_of_entry_records / $per_page;

//$_SESSION['sqlstatement'] = $sql;
$sql .= " LIMIT " . $per_page . "  OFFSET " . $offset;
echo $sql;
$result = $conn->query($sql);
$count = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($count < 10){
        echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h1>Date Posted:" . $row["dateposted"]."</h1></a><br>";
        echo "Author: " . userValidation($row["username"])."<br><br>";
        if(isset($_GET['link'])){
          //echo "uh";
          $_SESSION['entryid'] = $_GET['link'];
          header( "Location: details.php" );
        }
        $count++;
        }
    }
} else {
    echo "0 results";
}

printURLs($page, $max_page);
function printURLs($page,$max)
{
  if($page == 0)
  {
    for ($x = 1; $x <= 3; $x++) {
    if($x-1 == $_SESSION['page'])
    {
      echo $x . "<br>";
    } else {
      echo "<a href=" . "'?page=" . $x-1 . "'>" . $x . "</a><br>";
    }

    }
    echo "<a href=" . "'?page=" . $page + 1 . "'>></a><br>";
    echo "<a href=" . "'?page=" . $max . "'>>></a><br>";
  } else if($page == $max)
  {
    for ($x = $max; $x <= $max - 3; $x--) {
      if($x-1 == $_SESSION['page'])
      {
        echo $x . "<br>";
      } else {
        echo "<a href=" . "'?page=" . $x-1 . "'>" . $x . "</a><br>";
      }
    }
    echo "<a href=" . "'?page=" . $page - 1 . "'><</a><br>";
    echo "<a href=" . "'?page=0'><<</a><br>";
  } else
  {
    echo "<a href=" . "'?page=" . $page + 1 . "'>></a><br>";
    echo "<a href=" . "'?page=" . $max . "'>>></a><br>";
    for ($x = $page; $x <= $page + 2; $x++) {
      if($x-1 == $_SESSION['page'])
      {
        echo $x . "<br>";
      } else {
        echo "<a href=" . "'?page=" . $x-1 . "'>" . $x . "</a><br>";
      }
    }
    echo "<a href=" . "'?page=" . $page - 1 . "'><</a><br>";
    echo "<a href=" . "'?page=0'><<</a><br>";
  }
  if(isset($_GET['page'])){
    $_SESSION['page'] = $_GET['page'];
    header( "Location: posts.php" );
  }
}
?>
<a href='logout.php'>LOG OUT</a><br>
