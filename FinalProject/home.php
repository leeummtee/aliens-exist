<!DOCTYPE HTML>
<!--I used P02 as reference -->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title> Home </title>
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/queries.css" rel="stylesheet">
  <!-- linking the fade animations that must be loaded in header -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <nav>
    <!-- logo in the top left -->
    <div class="topnav">
      <div class="topnav-left">
        <a href="home.php">
          <span class="logo"> Logo </span>
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

  <section class="container-header">
    <div class="block">
      <header class="header-text-detailed">
        <h1 id="project-header"> Aliens Exist Brah </h1>
        <p> Dem flying saucers really be out der my guys. Stay safe out there. </p>
        <!-- down arrow reference: https://www.w3schools.com/howto/howto_css_arrows.asp -->
        <p><i class="arrow down"></i></p>
      </header>
    </div>
  </section>

  <section class="container-for-you">
      <a href="#"><img class="home-listing" src="imgs/mike.jpeg" alt="ufo"></a>
      <a href="#"><img class="home-listing" src="imgs/mike.jpeg" alt="ufo"></a>
      <a href="#"><img class="home-listing" src="imgs/mike.jpeg" alt="ufo"></a>
      <a href="#"><img class="home-listing" src="imgs/mike.jpeg" alt="ufo"></a>
      <a href="#"><img class="home-listing" src="imgs/mike.jpeg" alt="ufo"></a>
      <a href="#"><img class="home-listing" src="imgs/mike.jpeg" alt="ufo"></a>
  </section>

  <footer class="section-divider-footer">
    <div class="container-footer">
      <p> ©2021 - Group2 | </p>
      <a class="link" href="#"> citations </a>
      <a class="link" href="#"> database </a>
      <a class="link" href="#"> github </a>
    </div>
  </footer>

  <!-- linking the animation library  -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <!-- linking javascript file -->
  <script src="js/main.js"></script>
</body>
