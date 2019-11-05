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
    <title>TerraCom | Dashboard</title>
  </head>
  <body>
    <!-- Navigation starts -->

    <?php include "dashboard-nav.php" ?>

    <!-- Navigation ends -->

    <!-- Dashboard header starts -->

    <?php include "dashboard-header.php" ?>

    <!-- Dashboard header ends -->

    <!-- Breadcrumb starts -->

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="add.php">Add Record</a></li>
          <li class="active">Staff Record</li>
        </ol>
      </div>
    </section>

    <!-- Breadcrumb ends -->

    <!-- Dashboard Details start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">New Staff Record</h3>
            </div>
            <div class="panel-body">

              <form class="row" action="includes/process-staff-server.php" method="POST" enctype="multipart/form-data">
                <div class="col-sm-6 col-sm-offset-3">

                  <?php if(!isset($_SESSION['stf-addok'])): ?>

                  <!-- Stage one -->
                  <div class="lead text-center bg-primary">
                    <p>Stage 1 of 2</p>
                  </div>
                  <div class="form-group">
                    <label for="hall">Title</label>
                    <input class="form-control" type="text" name="title" placeholder="Title...">
                  </div>
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input class="form-control" type="text" name="firstName" placeholder="First name...">
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="text" name="lastName" placeholder="Last name...">
                  </div>
                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="date" name="dob">
                  </div>
                  <div class="form-group">
                    <label for="sex">Sex: </label>
                    <select class="form-control" name="sex">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="course">Department</label>
                    <input class="form-control" type="text" name="department" placeholder="Department...">
                  </div>
                  <button type="submit" name="add" class="btn btn-primary">SAVE RECORD</button>

                <!-- Stage one ends -->
              <?php  else:?>

                <!-- Stage two -->
                <div class="lead text-center bg-primary">
                  <p>Stage 2 of 2</p>
                </div>

                <div class="form-group">
                  <p class="">If you don't want to add the photo now. Click <button name="canceladd" class="btn btn-danger btn-sm" type="submit"> CANCEL</button></p>
                  <label for="file">Upload Profile Image</label>
                  <input class="form-control" type="file" name="file">
                  <p class="help-block">Only png and jpg files are allowed!</p>
                </div>

                <button type="submit" name="addimage" class="btn btn-primary">UPLOAD</button>
              </div>
              <!-- Stage two ends -->
            <?php endif; ?>
              </form>
            </div>
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
</html>
