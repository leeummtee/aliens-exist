<html>
<head>
  <title>Posts</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="css/styling.css" rel="stylesheet">
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

    <section class="container-search">
      <div class="block-login-buttons">
        <h1> UFO Encounter Posts </h1>
        <form action="" method="post">
        <input class="input-text" type="text" name="query" placeholder="Enter keywords..."/ value= "<?php if (isset($_POST['query'])) echo $_POST['query'];?>"/>
        <div class="container-login-buttons">
          <div class="block-checkboxes">
            <p class="search">Ufo Shape:</p>
            <input type="checkbox" id="fireball" name="fireball" value="fireball" <?php if(isset($_POST['fireball'])) echo 'checked="checked"'; ?>>
            <label for="fireball">Fireball</label><br>
            <input type="checkbox" id="disk" name="disk" value="disk"  <?php if(isset($_POST['disk'])) echo 'checked="checked"'; ?>>
            <label for="disk">Disk</label><br>
            <input type="checkbox" id="triangle" name="triangle" value="triangle" <?php if(isset($_POST['triangle'])) echo 'checked="checked"'; ?>>
            <label for="triangle">Triangle</label><br>
            <input type="checkbox" id="circle" name="circle" value="circle" <?php if(isset($_POST['circle'])) echo 'checked="checked"'; ?>>
            <label for="circle">Circle</label><br>
            <input type="checkbox" id="other" name="other" value="other" <?php if(isset($_POST['other'])) echo 'checked="checked"'; ?>>
            <label for="other">Other</label><br></form>
            <!-- <label class="posts-sort" for="sort-list">Sort by:</label> -->
          </div>
          <div class="block-checkboxes-2">
            <p class="search"> Sort By: </p>
            <select class="padding" name="sort-list" id="sort-list">
            <option value="dateposted_newest" <?php echo (isset($_POST['dateposted_newest']) && $_POST['dateposted_newest'] == 'Newest to oldest') ? 'selected' : ''; ?>>Newest to oldest</option>
            <option value="dateposted_oldest"  <?php echo (isset($_POST['dateposted_oldest']) && $_POST['dateposted_oldest'] == 'Oldest to newest') ? 'selected' : ''; ?>>Oldest to newest</option>
            <option value="most_popular" <?php echo (isset($_POST['most_popular']) && $_POST['most_popular'] == 'Most popular') ? 'selected' : ''; ?>>Most popular</option>
            <option value="least_popular" <?php echo (isset($_POST['least_popular']) && $_POST['least_popular'] == 'Least popular') ? 'selected' : ''; ?>>Least popular</option>
            </select>
            <br>
            <div class="test">
              <input class="button-form" type="submit" value="Search" name = "search"/>
            </div>
          </div>
        </div>

        </div>
        </form>
      </div>
    </section>

    <section class="container-login">
    <!-- reference for sidenav from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav -->
    <!-- reference for making sidenav accessible with tab index https://knowbility.org/blog/2020/accessible-slide-menus/ -->
    <button class="icon-right-justified" onclick="openNav()">&#9776;</button>
    <div id="mySidenav" class="sidenav inactive">
      <a href="javascript:void(0)" role="button" class="closebtn" aria-label="close navigation" onclick="closeNav()">&times;</a>
      <a href="login.php">login</a>
      <a href="signup.php">sign up</a>
      <a href="posts.php">posts</a>
      <a href="home.php">home</a>
      <a href="logout.php">logout</a>

    </div>
  </nav>

<?php
include_once("database.php");
session_start();
//$_SESSION['page'] = 0;
if(!isset($_SESSION['page'])){
  $_SESSION['page'] = 0;
}
//echo "page" . $_SESSION['page'];

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
  //if($_SESSION['test']){
  //  $_SESSION['test'] = false;
    //return true;
  //}
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
          $sql_statement .= "(shape != '" . $other[$x] . "'";
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
        $sql_statement .= "(shape = '" . $shapes_include[$x] . "'";
      }else if($x == ($counter -1))
      {
        $sql_statement .= " OR shape = '" . $shapes_include[$x] . "')";
      }else{
        $sql_statement .= " OR shape = '" . $shapes_include[$x] . "'";
      }
    }
  }

  if($sql_statement == " WHERE " || (checkFireball() && checkDisk() && checkTriangle() && checkCircle() && checkOther()))
    $sql_statement = "";

  return $sql_statement;
}
$sql .= howManyShapes();

if(isset($_POST['search']) && isset($_POST['query']))
{
  $query = $_POST['query'];
  if(strpos($sql, 'WHERE') == false){
  $sql .= " WHERE (comment LIKE '%" .$query. "%') OR (shape LIKE '%".$query."%')";
} else {
  $sql .= " AND ((comment LIKE '%" .$query. "%') OR (shape LIKE '%".$query."%'))";
}
}

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
  //  echo $num_of_entry_records;
  }
}
$max_page = $num_of_entry_records / $per_page;

//$_SESSION['sqlstatement'] = $sql;
$sql .= " LIMIT " . $per_page . "  OFFSET " . $offset;
  //echo $sql;
$result = $conn->query($sql);
$count = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($count < 10){
        echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
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
      echo "<a ". "href=" . "'?page=" . $x-1 . "'>" . $x . "</a><br>";
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
</section>

<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

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
