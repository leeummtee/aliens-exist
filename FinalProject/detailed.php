<html>
<head>
  <title>Login Page</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Detailed</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="css/styling.css" rel="stylesheet">
</head>

<body id="login">
  <nav>
    <!-- logo in the top left -->
    <div class="topnav">
      <div class="topnav-left">
        <a href="projects.html">
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

 <section class="container-login">
    <div class="block-login">
      <form action = "detailed.php" method = "POST">
        <div class="container-login-logo">
          <img class="logo-img" src="imgs/logo.png" alt="ufo logo">
        </div>

        <h1> UFOs spotted in da area of Surrey... </h1>
        <h4> Author: </h4> <p> anonymous </p>
        <h4> Country: </h4> <p> US </p>
        <h4> City: </h4> <p> vanleer </p>
        <h4> Shape: </h4> <p> cylinder </p>
        <h4> Latitude: </h4> <p> 36.235 </p>
        <h4> Longitude: </h4> <p> -87.4438889 </p>
        <h4> Date and Time of Occurance: </h4> <p> 2009-02-22 20:19:00 </p>
        <h4> Duration (secs): </h4> <p> 2700 </p>
        <h4> Duration (hrs and mins): </h4> <p> 45+ minutes </p>
        <h4> Description: </h4> <p> Bright light in atmosphere miles away. </p>

        <p>
          <input class="comment-text" type = "password" id ="pass" name  = "pass" placeholder="Enter Comment"/>
        </p>

        <div class="container-login-buttons">
          <input class="button-form" type =  "button" value = "Post" id = "post"/>
        </div>

    </div>
      </form>
  </section>

  <footer class="section-divider-footer">
    <div class="container-footer">
      <p> ©2021 - Group2 | </p>
      <a class="link" href="#"> citations </a>
      <a class="link" href="#"> database </a>
      <a class="link" href="#"> github </a>
    </div>
  </footer>
</body>

</html>
