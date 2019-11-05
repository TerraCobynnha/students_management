<?php
  include "includes/check-login.php";
  include_once "includes/server.php";
  $stresult = mysqli_query($conn, "SELECT * FROM staffdetails;");

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
          <li><a href="view.php">View Records</a></li>
          <li class="active">Staff Records</li>
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
              <h3 class="panel-title">Staff Records</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Photo</th>
                  <th>Index no.</th>
                  <th>Title</th>
                  <th colspan="2">Full Name</th>
                  <th>Date of birth</th>
                  <th>Sex</th>
                  <th>Department</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($stresult)) :?>

                  <?php
                    $id = $row['stf_id'];
                    if ($row['stf_imgstat'] == 1) {
                      $sql = "SELECT * FROM staffgallery WHERE img_stfid='$id';";
                      $imResult = mysqli_query($conn, $sql);
                      $imPath = mysqli_fetch_assoc($imResult);
                      $path = $imPath['img_folder'].$imPath['img_fullname'].'?'.mt_rand();
                    } else {
                      $path = "./images/defaultprofile.png";
                    }

                  ?>

                  <tr class="view-record-entry">
                    <td><div id="viewImg" style="background-image: url(<?php echo $path; ?>)"></div></td>
                    <td><?php echo $row['stf_id'];?></td>
                    <td><?php echo $row['stf_title'];?></td>
                    <td colspan="2"><?php echo $row['stf_first']." ".$row['stf_last'];?></td>
                    <td><?php echo $row['stf_dob'];?></td>
                    <td><?php echo $row['stf_sex'];?></td>
                    <td><?php echo $row['stf_department'];?></td>
                  </tr>

                <?php endwhile; ?>

                <!-- Works when no records are available -->
                <?php if (mysqli_num_rows($stresult) < 1) {
                    echo "<p>No records available</p>";
                } ?>
              </table>
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
