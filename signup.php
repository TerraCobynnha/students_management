<?php
  include "includes/check-login.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="A web application for managing student records">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>TerraCom | Signup</title>
  </head>
  <body>
    <!-- Navigation starts -->

    <?php include "dashboard-nav.php" ?>

    <!-- Navigation ends -->

    <!-- Form body start -->
    <div class="container" id="signup-container">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">Add New Admin Account</h3>
            </div>
            <div class="panel-body">
              <form class="row" action="includes/signup-server.php" method="POST">

                <!-- Signup form ends -->

                <div class="well col-sm-4 col-sm-offset-3">
                  <div class="form-group">
                    <label for="adUsername">Username</label>
                    <input type="text" name="adUsername" class="form-control" placeholder="Username ..." required>
                  </div>
                  <div class="form-group">
                    <label for="adEmail">E-mail</label>
                    <input type="email" name="adEmail" class="form-control" placeholder="Email address ..." required>
                  </div>
                  <div class="form-group">
                    <label for="adpwd">Password</label>
                    <input id="pwd" type="password" name="adpwd" class="form-control" placeholder="Password ..." required>
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </div>
                  <div class="form-group">
                    <label for="r-adpwd">Repeat Password</label>
                    <input id="rpwd" type="password" name="r-adpwd" class="form-control" placeholder="Repeat password ..." required>
                  </div>
                  <button id="signup-btn" type="submit" name="signup" class="btn btn-primary btn-block">SIGNUP</button>
                </div>

                <!-- Signup form ends -->

                <!-- Message box starts -->

                <div id="msg-box" class="well col-sm-offset-1 col-sm-3">
                  <ul type="circle">
                    <li><p>Username can contain only alphabets (a-z) and numbers (0-9).</p></li>
                    <li><p id="p-length">Password must be at least 8 characters.</p></li>
                    <li><p id="p-match">Passwords must match exactly.</p></li>

                    <!-- Feedback message after signup starts -->
                    <?php
                      if (isset($_GET['signup'])){
                        if ($_GET['signup'] == "success"){
                          echo '<li><p class="alert alert-success">Admin signup successful!</p></li>';
                        }

                      } else if (isset($_GET['error'])){
                        if ($_GET['error'] == "usertaken"){
                          echo '<li><p class="alert alert-warning">Username is already taken!</p></li>';
                        }
                      }
                    ?>
                    <!-- Feedback message after signup ends -->


                  </ul>
                </div>

                <!-- Message box ends -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Dashboard Details ends -->


    <!-- Footer starts -->
    <footer id="footer">
      <p>Copyright TerraCom, &copy; 2018</p>
    </footer>
    <!-- Footer ends -->

  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(function(){

      let pwd;

      // Disabled signup button
      $("#signup-btn").attr("disabled","disabled");

      //When a key is entered
      $("#pwd, #rpwd").keyup(()=>{
        pwd = $("#pwd").val();

        if (pwd.length < 8) {
          $("#p-length").html("Password is too short!");
          $("#p-length").css("color","#f00");
        } else {
          $("#p-length").html("Password length is fine!");
          $("#p-length").css("color","#0f0");
        }

        if (pwd !== $("#rpwd").val()) {
          $("#p-match").html("Passwords do not match!");
          $("#p-match").css("color","#f00");
          $("#signup-btn").attr("disabled","disabled");

        } else if (pwd === $("#rpwd").val() && pwd.length >= 8){
          $("#p-match").html("Passwords match exactly!");
          $("#p-match").css("color","#0f0");

          $("#signup-btn").removeAttr("disabled");

        }
      });

      //Eye icon handler
      $(".glyphicon-eye-open").on("click",function(){
        $(this).toggleClass("glyphicon-eye-close");

        let type = $("#pwd").attr("type");

        if (type == "text") {
          $("#pwd").attr("type","password");
        } else {
          $("#pwd").attr("type","text");
        }

      });
    });
  </script>
</html>
