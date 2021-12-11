<!DOCTYPE HTML>
<!--I used P02 as reference -->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title> Home </title>
  <link href="css/main.css" rel="stylesheet">
  <!-- <link href="css/queries.css" rel="stylesheet"> -->
  <!-- linking the fade animations that must be loaded in header -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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

  <section class="container-header">
    <div class="block">
      <header class="header-text-detailed">
        <h1 id="project-header"> UFO encounters for you.</h1>
        <p> A few posts based on your preferences. </p>
        <!-- down arrow reference: https://www.w3schools.com/howto/howto_css_arrows.asp -->
        <p><i class="arrow down"></i></p>
      </header>
    </div>
  </section>

  <section class="container-for-you">
    <div class="block-for-you">
      <a href="#"><img class="home-listing" src="imgs/ufo2.png" alt="ufo"></a>
      <h2> encounter date </h2>
      <p> by 10bitkun </p>
    </div>

    <div class="block-for-you">
      <a href="#"><img class="home-listing" src="imgs/ufo3.jpeg" alt="ufo"></a>
      <h2> encounter date </h2>
      <p> by angrimonki </p>
    </div>

    <div class="block-for-you">
      <a href="#"><img class="home-listing" src="imgs/ufo4.png" alt="ufo"></a>
      <h2> encounter date </h2>
      <p> by oogabooga </p>
    </div>

    <div class="block-for-you">
      <a href="#"><img class="home-listing" src="imgs/ufo5.png" alt="ufo"></a>
      <h2> encounter date </h2>
      <p> by mariofan4462 </p>
    </div>

    <div class="block-for-you">
      <a href="#"><img class="home-listing" src="imgs/ufo6.png" alt="ufo"></a>
      <h2> encounter date </h2>
      <p> by cloaked goliath </p>
    </div>

    <div class="block-for-you">
      <a href="#"><img class="home-listing" src="imgs/ufo7.png" alt="ufo"></a>
      <h2> encounter date </h2>
      <p> by bubbles </p>
    </div>
  </section>

  <footer class="section-divider-footer">
  	<div class="container-footer">
  		<p> ©2021 - Group2 | </p>
  		<a class="link" href="login.php"> login </a>
  		<a class="link" href="signup.php"> sign up </a>
  		<a class="link" href="posts.php"> posts </a>
  	</div>
  </footer>

  <!-- linking the animation library  -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <!-- linking javascript file -->
  <script src="js/main.js"></script>
</body>
