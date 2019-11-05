<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="A web application for managing student records">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>TerraCom | Home</title>
  </head>
  <body>
    <!-- Navigation starts -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">TerraCom</a>
        </div>

        <div id="myNavbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class='active'><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php

            if(isset($_SESSION['adminName'])) {
              echo "<li ><a href='dashboard.php'>Dashboard</a></li>";
            }
            ?>
          </ul>

          <!-- Login / Logout form starts-->
            <?php
              if(!isset($_SESSION['adminName'])) {
                echo "<form class='navbar-form navbar-right' action='./includes/signin.php' method='post'>
                        <div class='form-group'>
                          <input class='form-control' type='text' name='username' placeholder='Username \ email ...'>
                        </div>
                        <div class='form-group' id='form-group-login'>
                          <input id='pwd-login' class='form-control' type='password' name='password' placeholder='Password ...'>
                          <span class='glyphicon glyphicon-eye-open'></span>
                        </div>
                        <button class='btn btn-primary' type='submit' name='signin'>LOGIN</button>
                      </form>";
              } else {
                echo "
                  <ul class='nav navbar-nav navbar-right'>
                    <li class='dropdown'>
                      <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Welcome, ".$_SESSION['adminName']."&nbsp;<span class='caret'></span></a>
                      <ul class='dropdown-menu'>
                        <li><a href='dashboard.php'>Dashboard View</a></li>
                        <li><a href='signup.php'>Admin Signup</a></li>
                        <li><a href='setting.php'>Settings View</a></li>
                      </ul>
                    </li>
                  <form class='navbar-form navbar-right' action='./includes/signin.php?signout=true' method='get'>
                <button class='btn btn-info' type='submit' name='signout'>LOGOUT</button></form></ul>";
              }
            ?>

          <!-- Login / Logout form ends -->

        </div>
      </div>
    </nav>
    <!-- Navigation ends -->

    <!-- Showcase starts -->
    <section id="showcase" class="jumbotron text-center">
      <div class="container">
        <!-- Login alert starts -->
          <?php

          if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>".$_SESSION['message']."</div>";
            unset($_SESSION['message']);
          }

          ?>
        <!-- Login alert ends -->
        <h1>Welcome to TerraCom</h1>
        <p>Manage the records of your students with this application. You can add, edit, view and delete student records on just a click of a button...</p>
        <a href="contact.php" class="btn btn-primary btn-lg">Get Admin Account</a>
        <a href="about.php" class="btn btn-primary btn-lg">Read More</a>
      </div>
    </section>
    <!-- Showcase ends -->

    <!-- Basic Sample features starts -->
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h2 class="panel-title">Basic Features</h2>
        </div>
        <div class="panel-body">
          <div id="sample-features" class="row">
            <div class="sample-box col-sm-4">
              <div class="well">
                <h2><span class="glyphicon glyphicon-briefcase" aria-hidden=true></span> Storage</h2>
                <p>Efficient and secured storage for all data about your students for easy accessibilty.</p>
              </div>
            </div>
            <div class="sample-box col-sm-4">
              <div class="well">
                <h2><span class="glyphicon glyphicon-cog"></span> Management</h2>
                <p>Manage all the data from one place to maintain integrity and accuracy.</p>
              </div>
            </div>
            <div class="sample-box col-sm-4">
              <div class="well">
                <h2><span class="glyphicon glyphicon-stats"></span> Reports</h2>
                <p>Generate useful reports for decision making based on stored data.</p>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>


    <!-- Basic Sample features ends -->


    <!-- Footer starts -->
    <footer id="footer">
      <p>Copyright TerraCom, &copy; 2018</p>
    </footer>
    <!-- Footer ends -->

  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/eye-handler.js">

  </script>
</html>
