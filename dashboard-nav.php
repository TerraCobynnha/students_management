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
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php

        if(isset($_SESSION['adminName'])) {
          echo "<li class='active'><a href='dashboard.php'>Dashboard</a></li>";
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
                    <div class='form-group'>
                      <input class='form-control' type='password' name='password' placeholder='Password ...'>
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
