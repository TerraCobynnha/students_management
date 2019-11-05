<?php
  session_start();

  include "server.php";

  // Handle add and update operations
  // stage one submit
  if (isset($_POST['add']) || isset($_POST['update'])) {

    $title = $_POST['title'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $department = $_POST['department'];
    $stat = 0;

    // ADD HANDLER
    if (isset($_POST['add'])) {
      // Verification of data input
      if (empty($firstName) || empty($lastName) || empty($dob) || empty($sex) || empty($title) || empty($department)) {
      header("location: ../add-staff.php?error=emptyfields&first=".$firstName."&last=".$lastname."&dob=".$dob."&sex=".$sex."&title=".$title."&dept=".$department);
      exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstName) ||  !preg_match("/^[a-zA-Z]*$/", $lastName)) {
      header("location: ../add-staff.php?error=invalidnames&first=&last=&dob=".$dob."&sex=".$sex."&title=".$title."&dept=".$department);
      exit();
    } else {
        $sql = "INSERT INTO staffdetails(stf_first, stf_last, stf_dob, stf_sex, stf_title, stf_department,stf_imgstat) VALUES(?, ?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../add-staff.php?error=sqlerror");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $dob, $sex, $title, $department, $stat);
          mysqli_stmt_execute($stmt);

          // Fetch id of new record input

          $sql = "SELECT stf_id FROM staffdetails WHERE stf_first=? AND stf_last=? AND stf_dob=? AND stf_imgstat=?;";

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Error";
          } else {
            mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $dob, $stat);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultArr = mysqli_fetch_assoc($result);
            $_SESSION['addId'] = $resultArr['stf_id'];
          }

          $_SESSION['stf-addok'] = "true";
          header("location: ../add-staff.php?addstat=firstok");
          $_SESSION['msg'] = "Record added successfully!";

          exit();
        }
      }

    // UPDATE HANDLER

    } else if ( isset($_POST['update']) ) {

      $id = $_POST['ed-id'];

      // Verification of data input
      if (empty($firstName) || empty($lastName) || empty($dob) || empty($sex) || empty($title) || empty($department)) {
      header("location: ../edit-staff.php?error=emptyfields&first=".$firstName."&last=".$lastname."&dob=".$dob."&sex=".$sex."&title=".$title."&dept=".$department);
      exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstName) ||  !preg_match("/^[a-zA-Z]*$/", $lastName)) {
      header("location: ../edit-staff.php?error=invalidnames&first=&last=&dob=".$dob."&sex=".$sex."&hall=".$hall."&crs=".$course);
      exit();
    } else {

        $sql = "UPDATE staffdetails SET stf_first=?, stf_last=?, stf_dob=?, stf_sex=?, stf_title=?, stf_department=? WHERE stf_id='$id';";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../edit.php?error=sqlerror");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $dob, $sex, $title, $department);
          mysqli_stmt_execute($stmt);


          $_SESSION['editId'] = $id;     // Id for record
          $_SESSION['editok'] = "true";
          header("location: ../edit-staff.php?edit-id=".$id."&update=firstok");
          $_SESSION['msg'] = "Record updated successfully!";

          exit();
        }

      }

    } else {
      header("location: ../index.php");
      exit();
    }

  }

  // Stage one add ends


  //Update cancel handler img upload
  if (isset($_POST['cancelupdate'])) {
    unset($_SESSION['editok']);
    header("location: ../edit-staff.php?update=done");
  }

  //Add cancel handler img upload
  if (isset($_POST['canceladd'])) {
    $addId = $_SESSION['addId'];

    $sql = "INSERT INTO staffgallery (img_stfid) VALUES ($addId);";

    $res = mysqli_query($conn,$sql);

    if(!$res) {
      echo "SQL error";
    }

    unset($_SESSION['stf-addok']);
    header("location: ../dashboard.php?upload=success");

  }


  // stage two image submit
  if (isset($_POST['addimage']) || isset($_POST['updateimg'])) {

      $file = $_FILES['file'];

      $fileName = $file['name'];
      $fileType = $file['type'];
      $fileTempName = $file['tmp_name'];
      $fileError = $file['error'];
      $fileSize = $file['size'];

      $fileExt = explode(".", $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array("jpg","jpeg","png");

      // insert new image
      if (isset($_POST['addimage'])) {
        $addId = $_SESSION['addId'];

        if (in_array($fileActualExt, $allowed)) {
          if ($fileError == 0) {
            if ($fileSize < 2000000) {

              $imageFullName = "staffimg".$addId.".".$fileActualExt;
              $folder = "images/";
              $fileDestination = "../".$folder.$imageFullName;

              $sql = "INSERT INTO staffgallery (img_stfid,img_folder,img_fullname) VALUES (?,?,?);";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt,$sql)) {
                echo "Sql statement failed";
                exit();
              } else {
                mysqli_stmt_bind_param($stmt,"sss",$addId,$folder,$imageFullName);
                mysqli_stmt_execute($stmt);

                // update img status records
                $sql = "UPDATE staffdetails SET stf_imgstat=1 WHERE stf_id ='$addId';";
                if (!mysqli_query($conn, $sql)) {
                  echo "error";
                  exit();
                }


                move_uploaded_file($fileTempName,$fileDestination);
                unset($_SESSION['stf-addok']);
                unset($_SESSION['addId']);
                header("location: ../dashboard.php?upload=success");

              }

            } else {
              header("location: ../add-staff.php?error=hugefile");
              exit();
            }
          } else {
            header("location: ../add-staff.php?error=internalerror");
            exit();
          }
        } else {
          header("location: ../add-staff.php?error=invalidfile");
          exit();
        }


        // Update image
        } else if (isset($_POST['updateimg'])) {
            $editId = $_SESSION['editId'];

            if (in_array($fileActualExt, $allowed)) {
              if ($fileError == 0) {
                if ($fileSize < 2000000) {

                  $imageFullName = "staffimg".$editId.".".$fileActualExt;
                  $folder = "images/";
                  $fileDestination = "../".$folder.$imageFullName;

                  $sql = "UPDATE staffgallery SET img_folder=?, img_fullname=? WHERE img_stfid=?;";
                  $stmt = mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "Sql statement failed";
                    exit();
                  } else {
                    mysqli_stmt_bind_param($stmt,"sss",$folder,$imageFullName,$editId);
                    mysqli_stmt_execute($stmt);

                    // update img status records
                    $sql = "UPDATE staffdetails SET stf_imgstat=1 WHERE stf_id ='$editId';";
                    if (!mysqli_query($conn, $sql)) {
                      echo "error";
                      exit();
                    }


                    move_uploaded_file($fileTempName,$fileDestination);
                    unset($_SESSION['editok']);
                    unset($_SESSION['editId']);
                    header("location: ../edit.php?updateupload=success");

                  }

                } else {
                  header("location: ../edit-staff.php?edit-id=".$id."error=hugefile");
                  exit();
                }
              } else {
                header("location: ../edit-staff.php?edit-id=".$id."error=internalerror");
                exit();
              }
            } else {
              header("location: ../edit-staff.php?edit-id=".$id."error=invalidfile");
              exit();
            }

        } else {
          header("location: ../index.php");
          exit();
        }
      }

    //Stage two submit ends


  //Delete record feature

  if (isset($_GET['del-id'])) {
     $id = $_GET['del-id'];

    $sql = "DELETE FROM staffdetails WHERE stf_id='$id';";

    if(!mysqli_query($conn, $sql)){
      echo "SQL error occured";
      exit();
    }

    $_SESSION['msg'] = "Record Deleted successfully!";
    header("location: ../delete-staff.php");

  }




?>
