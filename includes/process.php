<?php
  session_start();

  include "server.php";

  // Handle add and update operations
  // stage one submit
  if (isset($_POST['add']) || isset($_POST['update'])) {

    // $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $hall = $_POST['hall'];
    $course = $_POST['course'];
    $stat = 0;

    // ADD HANDLER
    if (isset($_POST['add'])) {
      // Verification of data input
      if (empty($firstName) || empty($lastName) || empty($dob) || empty($sex) || empty($hall) || empty($course)) {
      header("location: ../add-student.php?error=emptyfields&first=".$firstName."&last=".$lastname."&dob=".$dob."&sex=".$sex."&hall=".$hall."&crs=".$course);
      exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstName) ||  !preg_match("/^[a-zA-Z]*$/", $lastName)) {
      header("location: ../add-student.php?error=invalidnames&first=&last=&dob=".$dob."&sex=".$sex."&hall=".$hall."&crs=".$course);
      exit();
    } else {
        $sql = "INSERT INTO studentdetails(std_first, std_last, std_dob, std_sex, std_hall, std_course,std_imgstat) VALUES(?, ?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../add-student.php?error=sqlerror");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $dob, $sex, $hall, $course, $stat);
          mysqli_stmt_execute($stmt);

          // Fetch id of new record input

          $sql = "SELECT std_id FROM studentdetails WHERE std_first=? AND std_last=? AND std_dob=? AND std_imgstat=?;";

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Error";
          } else {
            mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $dob, $stat);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultArr = mysqli_fetch_assoc($result);
            $_SESSION['addId'] = $resultArr['std_id'];
          }

          $_SESSION['addok'] = "true";
          header("location: ../add-student.php?addstat=firstok");
          $_SESSION['msg'] = "Record added successfully!";

          exit();
        }
      }

    // UPDATE HANDLER

    } else if ( isset($_POST['update']) ) {

      $id = $_POST['ed-id'];

      // Verification of data input
      if (empty($firstName) || empty($lastName) || empty($dob) || empty($sex) || empty($hall) || empty($course)) {
      header("location: ../edit-student.php?error=emptyfields&first=".$firstName."&last=".$lastname."&dob=".$dob."&sex=".$sex."&hall=".$hall."&crs=".$course);
      exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstName) ||  !preg_match("/^[a-zA-Z]*$/", $lastName)) {
      header("location: ../edit-student.php?error=invalidnames&first=&last=&dob=".$dob."&sex=".$sex."&hall=".$hall."&crs=".$course);
      exit();
    } else {

        $sql = "UPDATE studentdetails SET std_first=?, std_last=?, std_dob=?, std_sex=?, std_hall=?, std_course=? WHERE std_id='$id';";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../edit-student.php?error=sqlerror");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $dob, $sex, $hall, $course);
          mysqli_stmt_execute($stmt);

          // Fetch id of new record input

          // $sql = "SELECT std_id FROM studentdetails WHERE std_first=? AND std_last=? AND std_dob=? AND std_imgstat=?;";
          //
          // if (!mysqli_stmt_prepare($stmt, $sql)) {
          //   echo "Error";
          // } else {
          //   mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $dob, $stat);
          //   mysqli_stmt_execute($stmt);
          //   $result = mysqli_stmt_get_result($stmt);
          //   $resultArr = mysqli_fetch_assoc($result);
          //   $_SESSION['addId'] = $resultArr['std_id'];
          // }


          $_SESSION['editId'] = $id;     // Id for record
          $_SESSION['editok'] = "true";
          header("location: ../edit-student.php?edit-id=".$id."&update=firstok");
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
    header("location: ../edit-student.php?update=done");
  }

  //Add cancel handler img upload
  if (isset($_POST['canceladd'])) {
    $addId = $_SESSION['addId'];

    $sql = "INSERT INTO studentgallery (img_stdid) VALUES ($addId);";

    $res = mysqli_query($conn,$sql);

    if(!$res) {
      echo "SQL error";
    }

    unset($_SESSION['addok']);
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

              $imageFullName = "studentimg".$addId.".".$fileActualExt;
              $folder = "images/";
              $fileDestination = "../".$folder.$imageFullName;

              $sql = "INSERT INTO studentgallery (img_stdid,img_folder,img_fullname) VALUES (?,?,?);";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt,$sql)) {
                echo "Sql statement failed";
                exit();
              } else {
                mysqli_stmt_bind_param($stmt,"sss",$addId,$folder,$imageFullName);
                mysqli_stmt_execute($stmt);

                // update img status records
                $sql = "UPDATE studentdetails SET std_imgstat=1 WHERE std_id ='$addId';";
                if (!mysqli_query($conn, $sql)) {
                  echo "error";
                  exit();
                }


                move_uploaded_file($fileTempName,$fileDestination);
                unset($_SESSION['addok']);
                unset($_SESSION['addId']);
                header("location: ../dashboard.php?upload=success");

              }

            } else {
              header("location: ../add-student.php?error=hugefile");
              exit();
            }
          } else {
            header("location: ../add-student.php?error=internalerror");
            exit();
          }
        } else {
          header("location: ../add-student.php?error=invalidfile");
          exit();
        }


        // Update image
        } else if (isset($_POST['updateimg'])) {
            $editId = $_SESSION['editId'];

            if (in_array($fileActualExt, $allowed)) {
              if ($fileError == 0) {
                if ($fileSize < 2000000) {

                  $imageFullName = "studentimg".$editId.".".$fileActualExt;
                  $folder = "images/";
                  $fileDestination = "../".$folder.$imageFullName;

                  $sql = "UPDATE studentgallery SET img_folder=?, img_fullname=? WHERE img_stdid=?;";
                  $stmt = mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "Sql statement failed";
                    exit();
                  } else {
                    mysqli_stmt_bind_param($stmt,"sss",$folder,$imageFullName,$editId);
                    mysqli_stmt_execute($stmt);

                    // update img status records
                    $sql = "UPDATE studentdetails SET std_imgstat=1 WHERE std_id ='$editId';";
                    if (!mysqli_query($conn, $sql)) {
                      echo "error";
                      exit();
                    }


                    move_uploaded_file($fileTempName,$fileDestination);
                    unset($_SESSION['editok']);
                    unset($_SESSION['editId']);
                    header("location: ../edit-student.php?updateupload=success");

                  }

                } else {
                  header("location: ../edit-student.php?edit-id=".$id."error=hugefile");
                  exit();
                }
              } else {
                header("location: ../edit-student.php?edit-id=".$id."error=internalerror");
                exit();
              }
            } else {
              header("location: ../edit-student.php?edit-id=".$id."error=invalidfile");
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

    $sql = "DELETE FROM studentdetails WHERE std_id='$id';";

    if(!mysqli_query($conn, $sql)){
      echo "SQL error occured";
      exit();
    }

    $_SESSION['msg'] = "Record Deleted successfully!";
    header("location: ../delete.php");

  }


?>
