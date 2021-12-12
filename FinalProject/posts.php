<html >
<head>
  <title>Posts</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="css/main.css" rel="stylesheet">
</head>
<body id=posts>
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
			<a href="home.php">home</a>
			<a href="posts.php">posts</a>
			<a href="add_posts.php">add posts</a>
			<a href="profile.php">profile</a>
			<a href="logout.php">logout</a>
    </div>
  </section>
  </nav>

<?php
include_once("database.php");
session_start();
//$_SESSION['page'] = 0;
if(!isset($_SESSION['page'])){
  $_SESSION['page'] = 0;
}

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
  if($counter == 1)
  {
    $sql_statement .= ")";
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

echo '<section class="container-posts">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($count < 10){
        // img
       echo '<div class="block-posts">';
       echo'<a href="#"><img src="imgs/ufo.webp" alt="ufo"></a>';
        echo '</div>';

        // text
       echo '<div class="block-posts">';
        echo "<br><br><a href=" . "'?link=" . $row["entryid"] . "'" . "<h3>Date Posted:" . $row["dateposted"]."</h3></a><br>";
       echo "Author: " . userValidation($row["username"])."<br><br>";
         echo '<input class="button-form" type="submit" value="View Details" name = "search"/>';
       echo '</div>';
        if(isset($_GET['link'])){
          //echo "uh";
          $_SESSION['entryid'] = $_GET['link'];
          header("Location: details.php");
        }
        $count++;
        }
    }
  } else {
    echo "0 results";
  }
  echo '</section>';
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
  } else
  {
    echo "<a href=" . "'?page=" . $page + 1 . "'>></a><br>";
    for ($x = $page; $x <= $page + 2; $x++) {
      if($x-1 == $_SESSION['page'])
      {
        echo $x . "<br>";
      } else {
        echo "<a href=" . "'?page=" . $x-1 . "'>" . $x . "</a><br>";
      }
    }
    echo "<a href=" . "'?page=" . $page - 1 . "'><</a><br>";
  }
  $_SESSION['page'] = $_GET['page'];
  if(isset($_GET['page'])){
    $_SESSION['page'] = $_GET['page'];
  }
}
printURLs($page, $max_page);
?>
</section>

<script>
// $(document).ready(function(){
//
//     filter_data();
//
//     function filter_data()
//     {
//         $('.filter_data').html('<div id="loading" style="" ></div>');
//         var action = 'fetch_data';
//         var minimum_price = $('#hidden_minimum_price').val();
//         var maximum_price = $('#hidden_maximum_price').val();
//         var brand = get_filter('brand');
//         var ram = get_filter('ram');
//         var storage = get_filter('storage');
//         $.ajax({
//             url:"fetch_data.php",
//             method:"POST",
//             data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
//             success:function(data){
//                 $('.filter_data').html(data);
//             }
//         });
//     }
//
//     function get_filter(class_name)
//     {
//         var filter = [];
//         $('.'+class_name+':checked').each(function(){
//             filter.push($(this).val());
//         });
//         return filter;
//     }
//
//     $('.common_selector').click(function(){
//         filter_data();
//     });
// });
</script>

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
