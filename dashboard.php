<?php
  include "includes/check-login.php";
  include "includes/dashboard-server.php";
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
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <!-- Breadcrumb ends -->

    <!-- Dashboard Details start -->
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="list-group">
              <a href="#" class="list-group-item active bg-info main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                Dashboard
              </a>
              <a href="view-student.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Students <span class="badge"><?php echo $numOfStudents; ?></span></a>
              <a href="view-staff.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Staff <span class="badge"><?php echo $numOfStaff; ?></span></a>
              <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admins <span class="badge"><?php echo $numOfAdmins; ?></span></a>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="panel panel-info">
              <div class="panel-heading main-color-bg">
                <h2 class="panel-title">Data Overview</h2>
              </div>
              <div class="panel-body">
                <div id="sample-features" class="row">
                  <div class="sample-box col-sm-4">
                    <div class="well">
                      <h2><span class="glyphicon glyphicon-user" aria-hidden=true></span> <?php echo $numOfStudents; ?></h2>
                      <h4>Students</h4>
                    </div>
                  </div>
                  <div class="sample-box col-sm-4">
                    <div class="well">
                      <h2><span class="glyphicon glyphicon-user"></span> <?php echo $numOfStaff; ?></h2>
                      <h4>Staff</h4>
                    </div>
                  </div>
                  <div class="sample-box col-sm-4">
                    <div class="well">
                      <h2><span class="glyphicon glyphicon-user"></span> <?php echo $numOfAdmins; ?></h2>
                      <h4>Admins</h4>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Latest Records</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>Photo</th>
                    <th>Index no.</th>
                    <th colspan="2">Full Name</th>
                    <th>Course</th>
                    <th>Hall</th>
                    <th>Added</th>
                  </tr>
                  <?php while ($row = mysqli_fetch_assoc($result)) :?>

                    <?php
                    $id = $row['std_id'];
                    if ($row['std_imgstat'] == 1) {
                      $sql = "SELECT * FROM studentgallery WHERE img_stdid='$id';";
                      $imResult = mysqli_query($conn, $sql);
                      $imPath = mysqli_fetch_assoc($imResult);
                      $path = $imPath['img_folder'].$imPath['img_fullname'].'?'.mt_rand();
                    } else {
                      $path = "./images/defaultprofile.png";
                    }

                    ?>

                    <tr class="view-record-entry">
                      <td><div id="viewImg" style="background-image: url(<?php echo $path; ?>)"></div></td>
                      <td><?php echo $row['std_id'];?></td>
                      <td colspan="2"><?php echo $row['std_first']." ".$row['std_last'];?></td>
                      <td><?php echo $row['std_course'];?></td>
                      <td><?php echo $row['std_hall'];?></td>
                      <td><?php echo $row['std_joined'];?></td>
                    </tr>

                  <?php endwhile; ?>
                </table>
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



    <!-- modals -->
    <!-- addform modal starts -->
    <div class="modal fade" id="addpage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="addform" action="includes/process.php" method="POST" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">New Record</h4>
          </div>
          <div class="modal-body">
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
              <label for="hall">Hall of residence</label>
              <input class="form-control" type="text" name="hall" placeholder="Hall name...">
            </div>
            <div class="form-group">
              <label for="course">Course</label>
              <input class="form-control" type="text" name="course" placeholder="Course...">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-primary">ADD RECORD</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- addform modal ends -->

    <!-- Edit id request modal -->

    <div class="modal fade" id="editrecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="addform" action="back/editServer.php" method="POST" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit a Record</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="index">Enter the Index number</label>
              <input class="form-control" type="text" name="index" placeholder="Index number...">
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="subindex" class="btn btn-primary">SUBMIT</button>
          </div>
          </form>
        </div>
      </div>
    </div>

 <!-- Edit id request ends -->

  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
