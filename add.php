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
          <li class="active">Add Record</li>
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
              <h3 class="panel-title text-center">New Record</h3>
            </div>
            <div class="panel-body">
              <div class="well text-center" id="optionchoose">
                  <a class="btn btn-primary btn-lg" href="add-student.php">Student Record</a>
                  <a class="btn btn-info btn-lg" href="add-staff.php">Staff Record</a>
              </div>

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
