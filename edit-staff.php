<?php
  include "includes/check-login.php";
  include_once "includes/server.php";
  $result = mysqli_query($conn, "SELECT * FROM staffdetails;");


  if (isset($_GET['edit-id'])) {
    $_SESSION['id'] = $_GET['edit-id'];
    $idEdit = $_GET['edit-id'];

    $sqlEdit = "SELECT * FROM staffdetails WHERE stf_id='$idEdit';";
    $resultEdit = mysqli_query($conn, $sqlEdit);

    if(!$resultEdit){
      echo "SQL error occured";
      exit();
    } else {
      $rowEdit = mysqli_fetch_assoc($resultEdit);
    }
  }
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
          <li><a href="edit.php">Edit Records</a></li>
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
              <h3 class="panel-title">All Records</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Photo</th>
                  <th>Title</th>
                  <th colspan="2">Full Name</th>
                  <th>Date of birth</th>
                  <th>Sex</th>
                  <th>Hall</th>
                  <th>Department</th>
                  <th>Action</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) :?>

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
                    <td><a href="edit-staff.php?edit-id=<?php echo $row['stf_id']; ?>" class="btn btn-primary edit-btn">Edit</a></td>
                  </tr>

                <?php endwhile; ?>

                <!-- Works when no records are available -->
                <?php if (mysqli_num_rows($result) < 1) {
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

    <!-- MODALS -->

    <!-- Button to trigger modal -->
    <button style="display:none;" type="button" id="modalbtn" data-toggle="modal" data-target="#editrecord"></button>

    <!-- modal edit form -->
    <div class="modal fade" id="editrecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="includes/process-staff-server.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Update Record</h4>
            </div>
            <div class="modal-body">

              <?php if (!isset($_SESSION['editok'])): ?>
              <div class="lead text-center bg-primary">
                <p>Stage 1 of 2</p>
              </div>
              <!-- Hidden form input-->
              <input type="hidden" name="ed-id" value="<?php echo $rowEdit['stf_id']; ?>">
              <div class="form-group">
                <label for="hall">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Title..." value="<?php echo $rowEdit['stf_title']; ?>">
              </div>
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control" type="text" name="firstName" placeholder="First name..." value="<?php echo $rowEdit['stf_first']; ?>">
              </div>
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control" type="text" name="lastName" placeholder="Last name..." value="<?php echo $rowEdit['stf_last']; ?>">
              </div>
              <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input class="form-control" type="date" name="dob" value="<?php echo $rowEdit['stf_dob']; ?>">
              </div>
              <div class="form-group">
                <label for="sex">Sex: </label>
                <input class="form-control" type="text" name="sex" value="<?php echo $rowEdit['stf_sex'];?>" list="sexoptions">
                <datalist id="sexoptions">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </datalist>
              </div>
              <div class="form-group">
                <label for="course">Department</label>
                <input class="form-control" type="text" name="department" placeholder="Course..." value="<?php echo $rowEdit['stf_department']; ?>">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="update" class="btn btn-primary"> UPDATE</button>
            </div>

          <?php else: ?>

            <div class="lead text-center bg-primary">
              <p>Stage 2 of 2</p>
            </div>

            <div class="form-group">
              <p class="">If you don't want to change the photo. Click <button name="cancelupdate" class="btn btn-danger btn-sm" type="submit"> CANCEL</button></p>
              <label for="file">Upload New Profile Image</label>
              <input class="form-control" type="file" name="file">
              <p class="help-block">Only png and jpg files are allowed!</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="updateimg" class="btn btn-primary">UPDATE</button>
            </div>

          <?php endif; ?>


          </form>
        </div>
      </div>
    </div>

    <!-- addform modal ends -->

  </body>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>


  <!-- Modal trigger click stuff -->
  <script type="text/javascript">
      <?php if(isset($_SESSION['id'])) :?>

          $(function(){
              $("#modalbtn").trigger("click");
          });

      <?php
        unset($_SESSION['id']);
        endif;
      ?>

      </script>
</html>
